<?php

namespace Intimai\Servicos\Solicitar\Andamento;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class AndamentoSolicitacao implements ServicoSolicitacao
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::ANDAMENTO_ENDPOINT . '/' . $this->id . self::SOLICITAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [];
    }
}