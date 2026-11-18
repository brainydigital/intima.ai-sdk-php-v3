<?php

namespace Intimai\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Intimai\Intimai;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Http\Message\RequestInterface;

abstract class TestCase extends BaseTestCase
{
    protected array $historico = [];
    private array $arquivos = [];

    protected function intimai(array $respostas = [], array $opcoes = []): Intimai
    {
        $this->historico = [];
        $respostas = $respostas ?: [new Response(200, [], '{"data":[]}')];
        $pilha = HandlerStack::create(new MockHandler($respostas));
        $pilha->push(Middleware::history($this->historico));

        return new Intimai('token-teste', array_merge($opcoes, ['handler' => $pilha]));
    }

    protected function requisicao(int $indice = 0): RequestInterface
    {
        return $this->historico[$indice]['request'];
    }

    protected function query(RequestInterface $requisicao): array
    {
        parse_str($requisicao->getUri()->getQuery(), $query);

        return $query;
    }

    protected function corpo(RequestInterface $requisicao): array
    {
        parse_str((string) $requisicao->getBody(), $corpo);

        return $corpo;
    }

    protected function camposMultipart(RequestInterface $requisicao): array
    {
        preg_match_all('/name="([^"]+)"(?:; filename="[^"]*")?\r\n(?:Content-[^\r]+\r\n)*\r\n(.*?)\r\n--/s', (string) $requisicao->getBody(), $partes, PREG_SET_ORDER);

        $campos = [];

        foreach ($partes as [, $nome, $valor]) {
            $campos[$nome] = $valor;
        }

        return $campos;
    }

    protected function arquivoTemporario(string $conteudo = '%PDF-1.4'): string
    {
        $caminho = tempnam(sys_get_temp_dir(), 'sdk');
        file_put_contents($caminho, $conteudo);
        $this->arquivos[] = $caminho;

        return $caminho;
    }

    protected function tearDown(): void
    {
        foreach ($this->arquivos as $caminho) {
            @unlink($caminho);
        }

        parent::tearDown();
    }
}
