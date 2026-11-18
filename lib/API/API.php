<?php

namespace Intimai\API;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Intimai\Exceptions\APIRequestException;

class API
{
    public const URL_BASE = 'https://app.intima.ai/api/v3';
    public const USER_AGENT = 'Intimai_SDK/3.1.0';
    public const HEADER_CODIGO_2FA = 'X-Codigo-2FA';

    private string $apiToken;
    private array $opcoesAPI;
    private Client $cliente;
    private string|Closure|null $codigo2fa = null;

    public function __construct(string $apiToken, array $opcoes = [])
    {
        $this->apiToken = $apiToken;
        $this->definirCodigo2fa($opcoes['codigo_2fa'] ?? null);
        unset($opcoes['codigo_2fa']);
        $this->opcoesAPI = $opcoes;
        $this->cliente = new Client();
    }

    public function definirCodigo2fa(string|callable|null $codigo): void
    {
        $this->codigo2fa = is_callable($codigo) ? Closure::fromCallable($codigo) : $codigo;
    }

    private function getOpcoes(int $pagina = 1, array $filtros = [], array $request = []): array
    {
        $headers = [
            'Accept' => 'application/json',
            'User-Agent' => self::USER_AGENT,
        ];

        if (!isset($request['multipart'])) {
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        $codigo2fa = $this->codigo2fa instanceof Closure ? ($this->codigo2fa)() : $this->codigo2fa;

        if ($codigo2fa !== null && $codigo2fa !== '') {
            $headers[self::HEADER_CODIGO_2FA] = (string) $codigo2fa;
        }

        $opcoes = array_merge($this->opcoesAPI, $request);
        $opcoes['headers'] = array_merge($headers, $this->opcoesAPI['headers'] ?? [], $request['headers'] ?? []);
        $opcoes['query'] = array_merge(
            ['api_token' => $this->apiToken, 'page' => $pagina],
            $this->opcoesAPI['query'] ?? [],
            $request['query'] ?? [],
            $filtros['filtros'] ?? $filtros
        );

        return $opcoes;
    }

    private function requisitar(string $metodo, string $endpoint, array $opcoes): array
    {
        try {
            $response = $this->cliente->request($metodo, self::URL_BASE . $endpoint, $opcoes);

            return json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (BadResponseException $exception) {
            throw APIRequestException::daResposta($exception);
        }
    }

    public function post(string $endpoint, array $request = []): array
    {
        return $this->requisitar('POST', $endpoint, $this->getOpcoes(request: $request));
    }

    public function get(string $endpoint, int $pagina = 1, array $filtros = [], array $request = []): array
    {
        return $this->requisitar('GET', $endpoint, $this->getOpcoes($pagina, $filtros, $request));
    }

    public function put(string $endpoint, array $request = []): array
    {
        return $this->requisitar('PUT', $endpoint, $this->getOpcoes(request: $request));
    }

    public function delete(string $endpoint): array
    {
        return $this->requisitar('DELETE', $endpoint, $this->getOpcoes());
    }
}
