<?php

namespace Intimai\Tests;

use Intimai\Modelos\Documento;
use Intimai\Modelos\ParteVinculada;
use Intimai\Modelos\Peticao;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorAlterarParaRegularAtualizacao;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorRegularAtualizacao;
use Intimai\Servicos\Cadastrar\Autenticador\AutenticadorCertificadoCadastro;
use Intimai\Servicos\Cadastrar\Autenticador\AutenticadorRegularCadastro;
use Intimai\Servicos\Solicitar\Consulta\ConsultaSolicitacao;
use Intimai\Servicos\Solicitar\ConsultaPreAnalise\ConsultaPreAnaliseSolicitacao;
use Intimai\Servicos\Solicitar\Protocolo\PJE\ProtocoloPjeSolicitacao;
use Intimai\Servicos\Solicitar\Protocolo\TJRJ\ProtocoloTjrjSegundoPassoSolicitacao;
use Intimai\Servicos\Solicitar\ProtocoloHabilitacao\PJE\ProtocoloHabilitacaoPjeSegundoPassoSolicitacao;
use Intimai\Utilidades\Polo;
use Intimai\Utilidades\TipoDeclaracao;
use Intimai\Utilidades\TipoSolicitacao;

class RequestsAtualizadasTest extends TestCase
{
    private const OAB = ['numero' => '12345', 'letra' => 'A', 'uf' => 'RJ'];

    public function test_consulta_e_pre_consulta_nao_enviam_token(): void
    {
        $esperado = [
            'autenticacao_id' => '5',
            'numero_processo' => '0000001-00.2026.8.19.0001',
            'nome_parte' => '',
            'nome_representante' => '',
            'oab' => ['numero' => '12345', 'letra' => 'A', 'uf' => 'RJ'],
            'numero_documento_parte' => '',
        ];

        $this->intimai()->servicos->solicitar(new ConsultaSolicitacao(5, '0000001-00.2026.8.19.0001', oab: self::OAB));
        $this->assertSame('/api/v3/consulta-processual/solicitar', $this->requisicao()->getUri()->getPath());
        $this->assertSame($esperado, $this->corpo($this->requisicao()));

        $this->intimai()->servicos->solicitar(new ConsultaPreAnaliseSolicitacao(5, '0000001-00.2026.8.19.0001', oab: self::OAB));
        $this->assertSame('/api/v3/pre-consulta-processual/solicitar', $this->requisicao()->getUri()->getPath());
        $this->assertSame($esperado, $this->corpo($this->requisicao()));
    }

    public function test_cadastro_regular_continua_igual_sem_os_campos_novos(): void
    {
        $this->intimai()->servicos->cadastrar(new AutenticadorRegularCadastro(3, self::OAB, 'usuario', 'senha'));

        $this->assertSame([
            'tribunal_id' => '3',
            'usuario' => 'usuario',
            'senha' => 'senha',
            'oab_numero' => '12345',
            'oab_letra' => 'A',
            'oab_uf' => 'RJ',
        ], $this->corpo($this->requisicao()));
    }

    public function test_cadastro_regular_com_varios_tribunais_certificado_perfil_e_secret(): void
    {
        $this->intimai()->servicos->cadastrar(new AutenticadorRegularCadastro(
            [3, 4],
            self::OAB,
            'usuario',
            'senha',
            idCertificado: 8,
            usuarioSigla: 'ADV',
            usuarioDescricao: 'Escritório',
            secret: 'JBSWY3DPEHPK3PXP'
        ));

        $this->assertSame('/api/v3/autenticador/regular/cadastrar', $this->requisicao()->getUri()->getPath());
        $this->assertSame([
            'tribunal_id' => ['3', '4'],
            'usuario' => 'usuario',
            'senha' => 'senha',
            'certificado_id' => '8',
            'oab_numero' => '12345',
            'oab_letra' => 'A',
            'oab_uf' => 'RJ',
            'usuario_sigla' => 'ADV',
            'usuario_descricao' => 'Escritório',
            'secret' => 'JBSWY3DPEHPK3PXP',
        ], $this->corpo($this->requisicao()));
    }

    public function test_cadastro_por_certificado_com_varios_tribunais_e_secret(): void
    {
        $this->intimai()->servicos->cadastrar(new AutenticadorCertificadoCadastro('3,4', self::OAB, 8, secret: 'JBSWY3DPEHPK3PXP'));

        $this->assertSame('/api/v3/autenticador/certificado/cadastrar', $this->requisicao()->getUri()->getPath());
        $this->assertSame([
            'tribunal_id' => '3,4',
            'certificado_id' => '8',
            'oab_numero' => '12345',
            'oab_letra' => 'A',
            'oab_uf' => 'RJ',
            'secret' => 'JBSWY3DPEHPK3PXP',
        ], $this->corpo($this->requisicao()));
    }

    public function test_login_regular_aceita_certificado(): void
    {
        $this->intimai()->servicos->atualizar(new AutenticadorRegularAtualizacao(5, 'usuario', 'senha', 8));
        $this->assertSame('/api/v3/autenticador/regular/5/atualizar', $this->requisicao()->getUri()->getPath());
        $this->assertSame(['usuario' => 'usuario', 'senha' => 'senha', 'certificado_id' => '8'], $this->corpo($this->requisicao()));

        $this->intimai()->servicos->atualizar(new AutenticadorRegularAtualizacao(5, senha: 'nova'));
        $this->assertSame(['senha' => 'nova'], $this->corpo($this->requisicao()));

        $this->intimai()->servicos->atualizar(new AutenticadorAlterarParaRegularAtualizacao(5, 'usuario', 'senha', 8));
        $this->assertSame('/api/v3/autenticador/regular/5/alterar-para-regular', $this->requisicao()->getUri()->getPath());
        $this->assertSame(['usuario' => 'usuario', 'senha' => 'senha', 'certificado_id' => '8'], $this->corpo($this->requisicao()));

        $this->intimai()->servicos->atualizar(new AutenticadorAlterarParaRegularAtualizacao(5, 'usuario', 'senha'));
        $this->assertSame(['usuario' => 'usuario', 'senha' => 'senha'], $this->corpo($this->requisicao()));
    }

    public function test_protocolo_pje_sem_peticao_nao_envia_peticao(): void
    {
        $documento = new Documento($this->arquivoTemporario('doc'), 1, 21, 'Documento');

        $this->intimai()->servicos->solicitar(new ProtocoloPjeSolicitacao(5, '0000001-00.2026.8.19.0001', 2, documentos: [$documento]));

        $campos = $this->camposMultipart($this->requisicao());

        $this->assertSame('/api/v3/pje/protocolo-processual/solicitar', $this->requisicao()->getUri()->getPath());
        $this->assertSame([
            'numero_processo' => '0000001-00.2026.8.19.0001',
            'autenticacao_id' => '5',
            'tipo_documento_mensagem_geral' => '2',
            'documentos[0][arquivo]' => 'doc',
            'documentos[0][tipo_documento]' => '21',
            'documentos[0][descricao_documento]' => 'Documento',
            'documentos[0][ordem]' => '1',
        ], $campos);
    }

    public function test_protocolo_pje_trabalhista_envia_peticao(): void
    {
        $peticao = new Peticao($this->arquivoTemporario('peticao'), 7, 'Petição');

        $this->intimai()->servicos->solicitar(new ProtocoloPjeSolicitacao(5, '0000001-00.2026.5.01.0001', 2, $peticao));

        $campos = $this->camposMultipart($this->requisicao());

        $this->assertSame('peticao', $campos['peticao[arquivo]']);
        $this->assertSame('7', $campos['peticao[tipo_documento]']);
        $this->assertSame('Petição', $campos['peticao[descricao_documento]']);
    }

    public function test_segunda_etapa_tjrj_envia_categoria_quando_informada(): void
    {
        $peticao = new Peticao($this->arquivoTemporario('peticao'), descricao: 'Petição');
        $partes = [new ParteVinculada('Fulano', 'Autor')];

        $this->intimai()->servicos->solicitar(new ProtocoloTjrjSegundoPassoSolicitacao(9, 100, $partes, $peticao, [], 200));

        $campos = $this->camposMultipart($this->requisicao());

        $this->assertSame('/api/v3/tjrj/protocolo-processual/9/segunda-etapa', $this->requisicao()->getUri()->getPath());
        $this->assertSame('100', $campos['classe_id']);
        $this->assertSame('200', $campos['categoria_id']);
        $this->assertSame('Fulano', $campos['partes_vinculadas[0][nome]']);
        $this->assertSame('Autor', $campos['partes_vinculadas[0][participacao]']);

        $this->intimai()->servicos->solicitar(new ProtocoloTjrjSegundoPassoSolicitacao(9, 100, $partes, $peticao));

        $this->assertArrayNotHasKey('categoria_id', $this->camposMultipart($this->requisicao()));
    }

    public function test_segunda_etapa_da_habilitacao_envia_como_a_collection(): void
    {
        $documento = new Documento($this->arquivoTemporario('procuracao'), 1, 21, 'Procuração');

        $this->intimai()->servicos->solicitar(new ProtocoloHabilitacaoPjeSegundoPassoSolicitacao(
            9,
            TipoSolicitacao::HABILITACAO_SIMPLES,
            TipoDeclaracao::DECLARACAO_SOB_PENA_DE_LEI,
            Polo::PASSIVO,
            [new ParteVinculada('node-1'), 'node-2'],
            3,
            'Descrição',
            'Mensagem',
            [$documento]
        ));

        $this->assertSame('/api/v3/pje/protocolo-habilitacao/9/segunda-etapa', $this->requisicao()->getUri()->getPath());
        $this->assertSame([
            'tipo_solicitacao' => '0',
            'tipo_declaracao' => '0',
            'polo' => '1',
            'tipo_documento_mensagem_geral' => '3',
            'descricao' => 'Descrição',
            'mensagem_geral' => 'Mensagem',
            'partes_vinculadas[0]' => 'node-1',
            'partes_vinculadas[1]' => 'node-2',
            'documentos[0][arquivo]' => 'procuracao',
            'documentos[0][tipo_documento]' => '21',
            'documentos[0][descricao_documento]' => 'Procuração',
            'documentos[0][ordem]' => '1',
        ], $this->camposMultipart($this->requisicao()));
    }

    public function test_segunda_etapa_da_habilitacao_sem_descricao_e_mensagem(): void
    {
        $this->intimai()->servicos->solicitar(new ProtocoloHabilitacaoPjeSegundoPassoSolicitacao(
            9,
            TipoSolicitacao::HABILITACAO_SIMPLES,
            TipoDeclaracao::TRT_NA_FORMA_DE_EXCECAO,
            Polo::ATIVO,
            ['node-1'],
            3
        ));

        $campos = $this->camposMultipart($this->requisicao());

        $this->assertArrayNotHasKey('descricao', $campos);
        $this->assertArrayNotHasKey('mensagem_geral', $campos);
        $this->assertSame('1', $campos['tipo_declaracao']);
    }
}
