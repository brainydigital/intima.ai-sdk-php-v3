<?php

namespace Intimai\Servicos\Resultado\Consulta;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Resultado\ServicoResultado;

class ConsultaResultado implements ServicoResultado
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::CONSULTA_ENDPOINT . '/' . $this->id . self::RESULTADO_ENDPOINT;
    }
}