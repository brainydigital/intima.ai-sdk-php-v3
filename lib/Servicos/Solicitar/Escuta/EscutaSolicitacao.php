<?php

namespace Intimai\Servicos\Solicitar\Escuta;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class EscutaSolicitacao implements ServicoSolicitacao
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::ESCUTA_ENDPOINT . '/' . $this->id . self::SOLICITAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [];
    }
}