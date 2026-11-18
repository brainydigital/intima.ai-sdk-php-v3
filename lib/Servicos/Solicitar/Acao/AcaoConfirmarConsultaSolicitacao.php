<?php

namespace Intimai\Servicos\Solicitar\Acao;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class AcaoConfirmarConsultaSolicitacao implements ServicoSolicitacao
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::ACAO_ENDPOINT . '/' . $this->id . self::CONFIRMAR_CONSULTA_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [];
    }
}
