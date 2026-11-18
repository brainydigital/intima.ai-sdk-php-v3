<?php

namespace Intimai\Tests;

use GuzzleHttp\Psr7\Response;
use Intimai\API\API;
use Intimai\Modelos\Certificado;
use Intimai\Servicos\Buscar\Acao\AcaoBusca;
use Intimai\Servicos\Cadastrar\Notificacao\NotificacaoEmailCadastro;
use Intimai\Servicos\SolicitarCadastro\Certificado\CertificadoSolicitacaoCadastro;

class APITest extends TestCase
{
    public function test_envia_token_na_query_e_headers_da_collection(): void
    {
        $this->intimai()->servicos->cadastrar(new NotificacaoEmailCadastro('a@b.com'));

        $requisicao = $this->requisicao();

        $this->assertSame('POST', $requisicao->getMethod());
        $this->assertSame('/api/v3/notificacao/email/cadastrar', $requisicao->getUri()->getPath());
        $this->assertSame(['api_token' => 'token-teste', 'page' => '1'], $this->query($requisicao));
        $this->assertSame('application/json', $requisicao->getHeaderLine('Accept'));
        $this->assertSame('application/x-www-form-urlencoded', $requisicao->getHeaderLine('Content-Type'));
        $this->assertSame(API::USER_AGENT, $requisicao->getHeaderLine('User-Agent'));
        $this->assertFalse($requisicao->hasHeader('X-Codigo-2FA'));
        $this->assertFalse($requisicao->hasHeader('Authorization'));
        $this->assertSame(['email' => 'a@b.com'], $this->corpo($requisicao));
    }

    public function test_codigo_2fa_vai_no_header_e_nunca_na_query(): void
    {
        $this->intimai([], ['codigo_2fa' => '482913'])->servicos->buscar(new AcaoBusca());

        $requisicao = $this->requisicao();

        $this->assertSame('482913', $requisicao->getHeaderLine('X-Codigo-2FA'));
        $this->assertArrayNotHasKey('codigo_2fa', $this->query($requisicao));
    }

    public function test_codigo_2fa_por_funcao_e_gerado_a_cada_request(): void
    {
        $codigos = ['111111', '222222'];
        $intimai = $this->intimai(
            [new Response(200, [], '{}'), new Response(200, [], '{}')],
            ['codigo_2fa' => function () use (&$codigos) {
                return array_shift($codigos);
            }]
        );

        $intimai->servicos->buscar(new AcaoBusca());
        $intimai->servicos->buscar(new AcaoBusca());

        $this->assertSame('111111', $this->requisicao(0)->getHeaderLine('X-Codigo-2FA'));
        $this->assertSame('222222', $this->requisicao(1)->getHeaderLine('X-Codigo-2FA'));
    }

    public function test_definir_codigo_2fa_depois_de_criar_o_cliente(): void
    {
        $intimai = $this->intimai([new Response(200, [], '{}'), new Response(200, [], '{}')]);

        $intimai->definirCodigo2fa('654321');
        $intimai->servicos->buscar(new AcaoBusca());
        $intimai->definirCodigo2fa(null);
        $intimai->servicos->buscar(new AcaoBusca());

        $this->assertSame('654321', $this->requisicao(0)->getHeaderLine('X-Codigo-2FA'));
        $this->assertFalse($this->requisicao(1)->hasHeader('X-Codigo-2FA'));
    }

    public function test_codigo_2fa_vazio_nao_envia_header(): void
    {
        $this->intimai([], ['codigo_2fa' => ''])->servicos->buscar(new AcaoBusca());

        $this->assertFalse($this->requisicao()->hasHeader('X-Codigo-2FA'));
    }

    public function test_headers_e_query_do_cliente_somam_aos_padrao(): void
    {
        $this->intimai([], [
            'headers' => ['X-Rastreio' => 'abc'],
            'query' => ['extra' => '1'],
        ])->servicos->buscar(new AcaoBusca());

        $requisicao = $this->requisicao();

        $this->assertSame('abc', $requisicao->getHeaderLine('X-Rastreio'));
        $this->assertSame('application/json', $requisicao->getHeaderLine('Accept'));
        $this->assertSame(['api_token' => 'token-teste', 'page' => '1', 'extra' => '1'], $this->query($requisicao));
    }

    public function test_filtros_e_pagina_vao_na_query(): void
    {
        $this->intimai()->servicos->buscar(new AcaoBusca(), 3, ['filtros' => ['status' => '13,14', 'per_page' => 50]]);

        $this->assertSame(
            ['api_token' => 'token-teste', 'page' => '3', 'status' => '13,14', 'per_page' => '50'],
            $this->query($this->requisicao())
        );
    }

    public function test_filtros_direto_no_array_tambem_vao_na_query(): void
    {
        $this->intimai()->servicos->buscar(new AcaoBusca(), 1, ['status' => '1,2', 'autenticadores_ids' => '5']);

        $this->assertSame(
            ['api_token' => 'token-teste', 'page' => '1', 'status' => '1,2', 'autenticadores_ids' => '5'],
            $this->query($this->requisicao())
        );
    }

    public function test_multipart_nao_leva_content_type_de_formulario(): void
    {
        $certificado = new Certificado($this->arquivoTemporario('pfx'), 'senha');

        $this->intimai()->servicos->solicitarCadastro(new CertificadoSolicitacaoCadastro($certificado));

        $requisicao = $this->requisicao();

        $this->assertStringStartsWith('multipart/form-data; boundary=', $requisicao->getHeaderLine('Content-Type'));
        $this->assertSame('application/json', $requisicao->getHeaderLine('Accept'));
        $this->assertSame(API::USER_AGENT, $requisicao->getHeaderLine('User-Agent'));
        $this->assertSame(['api_token' => 'token-teste', 'page' => '1'], $this->query($requisicao));
        $this->assertSame(
            ['arquivo' => 'pfx', 'senha' => 'senha', 'senha_confirmation' => 'senha'],
            $this->camposMultipart($requisicao)
        );
    }

    public function test_resposta_sem_corpo_devolve_array_vazio(): void
    {
        $resultado = $this->intimai([new Response(204)])->servicos->buscar(new AcaoBusca());

        $this->assertSame([], $resultado);
    }
}
