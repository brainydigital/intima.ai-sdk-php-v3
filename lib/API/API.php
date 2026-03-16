<?php

namespace Intimai\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use Intimai\Exceptions\APIRequestException;

class API
{
    public const URL_BASE = 'https://app.intima.ai/api/v3';
    private string $apiToken;
    private array $opcoesAPI;
    private Client $cliente;

    /**
     * Construtor para instanciação da API.
     * @param string $apiToken
     * @param array $opcoes
     */
    public function __construct(string $apiToken, array $opcoes = [])
    {
        $this->apiToken = $apiToken;
        $this->cliente = new Client();
        $this->opcoesAPI = $opcoes;
    }

    private function getOpcoes(int $pagina = 1, array $filtros = [], array $request = []): array
    {
        $opcoesPadrao = [
            'base_uri' => self::URL_BASE,
            'headers' => [
                'Accept' => 'application/json',
                'User-Agent' => 'Intimai_SDK/3.0.0',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'query' => [
                'api_token' => $this->apiToken,
                'page' => $pagina
            ]
        ];

        $opcoes = array_merge($opcoesPadrao, $this->opcoesAPI, $request);

        if (!empty($filtros['filtros'])) {
            foreach ($filtros['filtros'] as $chave => $valor) {
                $opcoes['query'][$chave] = $valor;
            }
        }

        return $opcoes;
    }

    /**
     * Requisição post para a API.
     * @param string $endpoint
     * @param array $request
     * @return array
     * @throws APIRequestException
     * @throws GuzzleException
     */
    public function post(string $endpoint, array $request = []): array
    {
        try {
            $opcoes = $this->getOpcoes(request: $request);
            $url = self::URL_BASE . $endpoint;

            $response = $this->cliente->post($url, $opcoes);

            return json_decode($response->getBody()->getContents(), true);
        } catch (BadResponseException $exception) {
            throw new APIRequestException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Requisição get para a API.
     * @param string $endpoint
     * @param int $pagina
     * @param array $filtros
     * @param array $request
     * @return array
     * @throws APIRequestException
     * @throws GuzzleException
     */
    public function get(string $endpoint, int $pagina = 1, array $filtros = [], array $request = []): array
    {
        try {
            $opcoes = $this->getOpcoes($pagina, $filtros, $request);
            $url = self::URL_BASE . $endpoint;

            $response = $this->cliente->get($url, $opcoes);

            return json_decode($response->getBody()->getContents(), true);
        } catch (BadResponseException $exception) {
            throw new APIRequestException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Requisição put para a API.
     * @param string $endpoint
     * @param array $request
     * @return array
     * @throws APIRequestException
     * @throws GuzzleException
     */
    public function put(string $endpoint, array $request = []): array
    {
        try {
            $opcoes = $this->getOpcoes(request: $request);
            $url = self::URL_BASE . $endpoint;

            $response = $this->cliente->put($url, $opcoes);

            return json_decode($response->getBody()->getContents(), true);
        } catch (BadResponseException $exception) {
            throw new APIRequestException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Requisição delete para a API.
     * @param string $endpoint
     * @return array
     * @throws APIRequestException
     * @throws GuzzleException
     */
    public function delete(string $endpoint): array
    {
        try {
            $opcoes = $this->getOpcoes();
            $url = self::URL_BASE . $endpoint;

            $response = $this->cliente->delete($url, $opcoes);

            return json_decode($response->getBody()->getContents(), true);
        } catch (BadResponseException $exception) {
            throw new APIRequestException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}