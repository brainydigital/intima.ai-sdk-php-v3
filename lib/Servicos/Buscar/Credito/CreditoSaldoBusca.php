<?php

namespace Intimai\Servicos\Buscar\Credito;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class CreditoSaldoBusca implements ServicoBusca
{
    use Endpoint;

    public function getEndpoint(): string
    {
        return self::CREDITO_ENDPOINT . self::SALDO_ENDPOINT;
    }
}