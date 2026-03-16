<?php

namespace Intimai\Servicos\Resultado\Escuta;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Resultado\ServicoResultado;

class EscutaResultado implements ServicoResultado
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::ESCUTA_ENDPOINT . '/' . $this->id . self::RESULTADO_ENDPOINT;
    }
}