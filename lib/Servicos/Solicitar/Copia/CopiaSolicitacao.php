<?php

namespace Intimai\Servicos\Solicitar\Copia;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class CopiaSolicitacao implements ServicoSolicitacao
{
    use Endpoint;

    private string|int $idAutenticador;
    private string $numeroDoProcesso;

    public function __construct(string|int $idAutenticador, string $numeroDoProcesso) {
        $this->idAutenticador = $idAutenticador;
        $this->numeroDoProcesso = $numeroDoProcesso;
    }

    public function getEndpoint(): string
    {
        return self::COPIA_ENDPOINT . self::SOLICITAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
          'form_params' => [
              'autenticacao_id' => $this->idAutenticador,
              'numero_processo' => $this->numeroDoProcesso
          ]
        ];
    }
}