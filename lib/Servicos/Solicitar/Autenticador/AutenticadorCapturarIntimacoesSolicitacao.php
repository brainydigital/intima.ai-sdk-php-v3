<?php

namespace Intimai\Servicos\Solicitar\Autenticador;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class AutenticadorCapturarIntimacoesSolicitacao implements ServicoSolicitacao
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::AUTENTICADOR_ENDPOINT . '/' . $this->id . self::CAPTURAR_INTIMACOES_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [];
    }
}
