<?php

namespace Intimai\Servicos\Buscar\Credito;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class CreditoHistoricoBusca implements ServicoBusca
{
    use Endpoint;

    public function getEndpoint(): string
    {
        return self::CREDITO_ENDPOINT . self::HISTORICO_ENDPOINT;
    }
}