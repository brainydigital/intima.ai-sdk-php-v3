<?php

namespace Intimai\Servicos\Resultado\Acao;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Resultado\ServicoResultado;

class AcaoResultado implements ServicoResultado
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::ACAO_ENDPOINT . '/' . $this->id . self::RESULTADO_ENDPOINT;
    }
}