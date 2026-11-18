<?php

namespace Intimai\Tests;

use GuzzleHttp\Psr7\Response;
use Intimai\Exceptions\APIRequestException;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorDesabilitarAtualizacao;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorHabilitarAtualizacao;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorPerfilAtualizacao;
use Intimai\Servicos\Buscar\Acao\AcaoBusca;
use Intimai\Servicos\Buscar\CapturaAgendada\CapturaAgendadaBusca;
use Intimai\Servicos\Buscar\CodigoAjuda\CodigoAjudaBusca;
use Intimai\Servicos\Buscar\Credito\CreditoConsumoMensalBusca;
use Intimai\Servicos\Buscar\Protocolo\TipoDocumentoMensagemGeral\TipoDocumentoMensagemGeralProjudiBusca;
use Intimai\Servicos\Cadastrar\Autenticador\AutenticadorDoisFatoresCadastro;
use Intimai\Servicos\Solicitar\Acao\AcaoCancelarConsultaSolicitacao;
use Intimai\Servicos\Solicitar\Acao\AcaoConfirmarConsultaSolicitacao;
use Intimai\Servicos\Solicitar\Autenticador\AutenticadorCapturarIntimacoesSolicitacao;
use Intimai\Utilidades\SituacaoCapturaAgendada;
use Intimai\Utilidades\SituacaoNovaTentativa;
use Intimai\Utilidades\StatusAcao;
use Intimai\Utilidades\TipoCapturaAgendada;

class RotasNovasTest extends TestCase
{
    private function assertRequisicao(string $metodo, string $caminho, array $corpo = []): void
    {
        $requisicao = $this->requisicao();

        $this->assertSame($metodo, $requisicao->getMethod());
        $this->assertSame('/api/v3' . $caminho, $requisicao->getUri()->getPath());
        $this->assertSame('token-teste', $this->query($requisicao)['api_token']);
        $this->assertSame($corpo, $this->corpo($requisicao));
    }

    public function test_confirmar_consulta(): void
    {
        $resposta = ['message' => 'Consulta Processual confirmada!', 'data' => ['id' => 9, 'status' => StatusAcao::NA_FILA]];

        $resultado = $this->intimai([new Response(200, [], json_encode($resposta))])
            ->servicos->solicitar(new AcaoConfirmarConsultaSolicitacao(9));

        $this->assertRequisicao('POST', '/acao/9/confirmar-consulta');
        $this->assertSame($resposta, $resultado);
    }

    public function test_cancelar_consulta(): void
    {
        $resultado = $this->intimai([new Response(200, [], '{"data":{"id":9,"status":14}}')])
            ->servicos->solicitar(new AcaoCancelarConsultaSolicitacao(9));

        $this->assertRequisicao('POST', '/acao/9/cancelar-consulta');
        $this->assertSame(StatusAcao::CANCELADA, $resultado['data']['status']);
    }

    public function test_confirmar_consulta_de_outro_usuario_da_404(): void
    {
        $this->expectException(APIRequestException::class);
        $this->expectExceptionCode(404);

        $this->intimai([new Response(404, [], '{"message":"Ação não encontrada."}')])
            ->servicos->solicitar(new AcaoConfirmarConsultaSolicitacao(1));
    }

    public function test_atualizar_perfil_do_autenticador(): void
    {
        $this->intimai()->servicos->atualizar(new AutenticadorPerfilAtualizacao(5, 'ADV', 'Escritório'));

        $this->assertRequisicao('PUT', '/autenticador/5/atualizar-perfil', [
            'usuario_sigla' => 'ADV',
            'usuario_descricao' => 'Escritório',
        ]);
    }

    public function test_atualizar_perfil_envia_so_o_campo_informado(): void
    {
        $this->intimai()->servicos->atualizar(new AutenticadorPerfilAtualizacao(5, usuarioDescricao: 'Escritório'));

        $this->assertRequisicao('PUT', '/autenticador/5/atualizar-perfil', ['usuario_descricao' => 'Escritório']);
    }

    public function test_capturar_intimacoes_agora(): void
    {
        $this->intimai()->servicos->solicitar(new AutenticadorCapturarIntimacoesSolicitacao(5));

        $this->assertRequisicao('POST', '/autenticador/5/capturar-intimacoes');
    }

    public function test_capturar_intimacoes_com_captura_desligada_da_422(): void
    {
        try {
            $this->intimai([new Response(422, [], '{"message":"Ative a captura de intimações deste autenticador para capturar agora."}')])
                ->servicos->solicitar(new AutenticadorCapturarIntimacoesSolicitacao(5));
            $this->fail('Deveria ter falhado.');
        } catch (APIRequestException $exception) {
            $this->assertSame(422, $exception->getStatus());
            $this->assertSame('Ative a captura de intimações deste autenticador para capturar agora.', $exception->getMensagem());
        }
    }

    public function test_habilitar_e_desabilitar_autenticador(): void
    {
        $this->intimai()->servicos->atualizar(new AutenticadorHabilitarAtualizacao(5));
        $this->assertRequisicao('PUT', '/autenticador/5/habilitar');

        $this->intimai()->servicos->atualizar(new AutenticadorDesabilitarAtualizacao(5));
        $this->assertRequisicao('PUT', '/autenticador/5/desabilitar');
    }

    public function test_armazenar_2fa_em_um_autenticador(): void
    {
        $this->intimai()->servicos->cadastrar(new AutenticadorDoisFatoresCadastro(5, 'JBSWY3DPEHPK3PXP'));

        $this->assertRequisicao('POST', '/autenticador/5/2fa/armazenar', ['secret' => 'JBSWY3DPEHPK3PXP']);
    }

    public function test_armazenar_2fa_em_varios_autenticadores(): void
    {
        $this->intimai()->servicos->cadastrar(new AutenticadorDoisFatoresCadastro([5, 6, 7], 'JBSWY3DPEHPK3PXP'));

        $this->assertRequisicao('POST', '/autenticador/5,6,7/2fa/armazenar', ['secret' => 'JBSWY3DPEHPK3PXP']);
    }

    public function test_consumo_mensal_com_e_sem_data(): void
    {
        $this->intimai()->servicos->buscar(new CreditoConsumoMensalBusca(), 1, ['filtros' => ['date' => '2026-10']]);
        $this->assertRequisicao('GET', '/credito/consumo-mensal');
        $this->assertSame('2026-10', $this->query($this->requisicao())['date']);

        $this->intimai()->servicos->buscar(new CreditoConsumoMensalBusca());
        $this->assertArrayNotHasKey('date', $this->query($this->requisicao()));
    }

    public function test_buscar_capturas_agendadas_com_filtros(): void
    {
        $this->intimai()->servicos->buscar(new CapturaAgendadaBusca(), 2, ['filtros' => [
            'data_inicial' => '01/11/2026',
            'data_final' => '13/11/2026',
            'autenticadores_ids' => '5,6',
            'tipos' => TipoCapturaAgendada::INTIMACAO,
            'situacoes' => SituacaoCapturaAgendada::NAO_EXECUTADA . ',' . SituacaoCapturaAgendada::ERRO,
        ]]);

        $this->assertRequisicao('GET', '/captura-agendada/buscar');
        $this->assertSame([
            'api_token' => 'token-teste',
            'page' => '2',
            'data_inicial' => '01/11/2026',
            'data_final' => '13/11/2026',
            'autenticadores_ids' => '5,6',
            'tipos' => 'intimacao',
            'situacoes' => 'nao_executada,erro',
        ], $this->query($this->requisicao()));
    }

    public function test_buscar_uma_captura_agendada(): void
    {
        $this->intimai()->servicos->buscar(new CapturaAgendadaBusca(31));

        $this->assertRequisicao('GET', '/captura-agendada/31/buscar');
    }

    public function test_buscar_tipos_documento_mensagem_geral_do_projudi(): void
    {
        $resposta = ['message' => 'Tipos documentos mensagem geral encontrados para o tribunal do autenticador selecionado!', 'data' => [['id' => 1, 'nome' => 'Petição']]];

        $resultado = $this->intimai([new Response(200, [], json_encode($resposta))])
            ->servicos->buscar(new TipoDocumentoMensagemGeralProjudiBusca(5));

        $this->assertRequisicao('GET', '/projudi/protocolo-processual/5/tipos-documento-mensagem-geral');
        $this->assertSame($resposta, $resultado);
    }

    public function test_tipos_documento_mensagem_geral_com_autenticador_fora_do_projudi_da_422(): void
    {
        try {
            $this->intimai([new Response(422, [], '{"message":"Este autenticador não pertence ao sistema Projudi"}')])
                ->servicos->buscar(new TipoDocumentoMensagemGeralProjudiBusca(5));
            $this->fail('Deveria ter falhado.');
        } catch (APIRequestException $exception) {
            $this->assertSame(422, $exception->getStatus());
            $this->assertSame('Este autenticador não pertence ao sistema Projudi', $exception->getMensagem());
        }
    }

    public function test_buscar_catalogo_de_codigos_de_ajuda(): void
    {
        $resposta = ['message' => 'Códigos encontrados!', 'data' => [
            'faixas' => [['value' => 'isenta', 'titulo' => 'Sem cobrança', 'total' => 47]],
            'nova_tentativa_aviso' => 'A nova tentativa automática só acontece nos códigos marcados, em ações criadas no mesmo dia.',
            'grupos' => [['nome' => 'Erros Gerais', 'slug' => 'erros-gerais', 'codigos' => [
                ['codigo' => 606, 'faixa' => 'isenta', 'nova_tentativa' => 'Nova tentativa automática: até 3×, a cada 30 min.'],
            ]]],
        ]];

        $resultado = $this->intimai([new Response(200, [], json_encode($resposta))])
            ->servicos->buscar(new CodigoAjudaBusca());

        $this->assertRequisicao('GET', '/codigo-ajuda/buscar');
        $this->assertArrayNotHasKey('codigo', $this->query($this->requisicao()));
        $this->assertSame($resposta, $resultado);
    }

    public function test_buscar_codigo_de_ajuda_pelo_codigo(): void
    {
        $this->intimai()->servicos->buscar(new CodigoAjudaBusca(), 1, ['codigo' => 606]);

        $this->assertRequisicao('GET', '/codigo-ajuda/buscar');
        $this->assertSame('606', $this->query($this->requisicao())['codigo']);
    }

    public function test_codigo_de_ajuda_fora_do_catalogo_da_404(): void
    {
        try {
            $this->intimai([new Response(404, [], '{"message":"Nenhum código encontrado no catálogo."}')])
                ->servicos->buscar(new CodigoAjudaBusca(), 1, ['codigo' => 99999]);
            $this->fail('Deveria ter falhado.');
        } catch (APIRequestException $exception) {
            $this->assertSame(404, $exception->getStatus());
            $this->assertSame('Nenhum código encontrado no catálogo.', $exception->getMensagem());
        }
    }

    public function test_acao_com_erro_traz_a_nova_tentativa_automatica(): void
    {
        $novaTentativa = [
            'automatica' => true,
            'situacao' => SituacaoNovaTentativa::AGENDADA,
            'tentativa' => 1,
            'max_tentativas' => 3,
            'prevista_para' => '2026-11-18 10:30:00',
            'mensagem' => 'Nova tentativa automática 1 de 3 a partir de 10:30. Não é preciso criar outra ação.',
        ];

        $resultado = $this->intimai([new Response(200, [], json_encode(['data' => ['id' => 9, 'status' => StatusAcao::ERRO, 'nova_tentativa' => $novaTentativa]]))])
            ->servicos->buscar(new AcaoBusca(9));

        $this->assertRequisicao('GET', '/acao/9/buscar');
        $this->assertSame($novaTentativa, $resultado['data']['nova_tentativa']);
    }

    public function test_situacoes_da_nova_tentativa_batem_com_a_api(): void
    {
        $this->assertSame(
            ['agendada', 'aguardando_condicao', 'encerrada', 'sem_nova_tentativa'],
            [SituacaoNovaTentativa::AGENDADA, SituacaoNovaTentativa::AGUARDANDO_CONDICAO, SituacaoNovaTentativa::ENCERRADA, SituacaoNovaTentativa::SEM_NOVA_TENTATIVA]
        );
    }
}
