<?php

namespace Intimai\Tests;

use GuzzleHttp\Psr7\Response;
use Intimai\Exceptions\APIRequestException;
use Intimai\Exceptions\DoisFatoresException;
use Intimai\Exceptions\LimiteDeRequisicoesException;
use Intimai\Servicos\Buscar\Acao\AcaoBusca;

class ExcecaoTest extends TestCase
{
    private function falhar(Response $resposta): APIRequestException
    {
        try {
            $this->intimai([$resposta])->servicos->buscar(new AcaoBusca());
        } catch (APIRequestException $exception) {
            return $exception;
        }

        $this->fail('A SDK deveria ter lançado APIRequestException.');
    }

    public function test_erro_de_validacao_expoe_status_corpo_e_erros(): void
    {
        $corpo = ['autenticacao_id' => ['O campo autenticacao id é obrigatório.']];

        $exception = $this->falhar(new Response(422, [], json_encode($corpo)));

        $this->assertSame(APIRequestException::class, $exception::class);
        $this->assertSame(422, $exception->getStatus());
        $this->assertSame(422, $exception->getCode());
        $this->assertSame($corpo, $exception->getCorpo());
        $this->assertSame($corpo, $exception->getErros());
        $this->assertSame(['code' => 422, 'error' => $corpo], $exception->toJson());
    }

    public function test_erro_de_negocio_com_codigo_nao_vira_erro_de_validacao(): void
    {
        $exception = $this->falhar(new Response(422, [], '{"error":"Complete seus dados fiscais.","code":613}'));

        $this->assertSame([], $exception->getErros());
        $this->assertSame('Complete seus dados fiscais.', $exception->getMensagem());
        $this->assertSame(613, $exception->getCorpo()['code']);
    }

    public function test_limites_do_plano_e_saldo_trazem_a_mensagem_da_api(): void
    {
        $this->assertSame(457, $this->falhar(new Response(457, [], '{"error":"Limite por hora atingido."}'))->getStatus());
        $this->assertSame(458, $this->falhar(new Response(458, [], '{"error":"Certificado inválido."}'))->getStatus());

        $saldo = $this->falhar(new Response(459, [], '{"error":"Você não possui saldo suficiente"}'));

        $this->assertSame(459, $saldo->getStatus());
        $this->assertSame('Você não possui saldo suficiente', $saldo->getMensagem());
    }

    public function test_401_de_2fa_vira_dois_fatores_exception(): void
    {
        foreach (['Código 2FA obrigatório', 'Código 2FA inválido', '2FA ativado: conclua o cadastro no painel'] as $mensagem) {
            $exception = $this->falhar(new Response(401, [], json_encode(['data' => ['error' => true, 'message' => $mensagem]])));

            $this->assertInstanceOf(DoisFatoresException::class, $exception);
            $this->assertSame(401, $exception->getStatus());
            $this->assertSame($mensagem, $exception->getMensagem());
        }
    }

    public function test_401_de_token_invalido_nao_e_de_2fa(): void
    {
        $exception = $this->falhar(new Response(401, [], '{"data":{"error":true,"message":"Unauthenticated"}}'));

        $this->assertSame(APIRequestException::class, $exception::class);
        $this->assertSame('Unauthenticated', $exception->getMensagem());
    }

    public function test_429_de_2fa_traz_retry_after(): void
    {
        $exception = $this->falhar(new Response(429, ['Retry-After' => '42'], '{"data":{"error":true,"message":"Muitos códigos 2FA inválidos. Tente novamente em instantes."}}'));

        $this->assertInstanceOf(LimiteDeRequisicoesException::class, $exception);
        $this->assertSame(42, $exception->getRetryAfter());
    }

    public function test_429_do_limite_geral_sem_retry_after_numerico(): void
    {
        $exception = $this->falhar(new Response(429, [], '{"message":"Too Many Attempts."}'));

        $this->assertInstanceOf(LimiteDeRequisicoesException::class, $exception);
        $this->assertNull($exception->getRetryAfter());
        $this->assertSame('Too Many Attempts.', $exception->getMensagem());
    }

    public function test_corpo_que_nao_e_json_fica_como_texto(): void
    {
        $exception = $this->falhar(new Response(500, [], 'Erro interno'));

        $this->assertSame(500, $exception->getStatus());
        $this->assertSame('Erro interno', $exception->getCorpo());
        $this->assertSame([], $exception->getErros());
        $this->assertSame($exception->getMessage(), $exception->getMensagem());
    }
}
