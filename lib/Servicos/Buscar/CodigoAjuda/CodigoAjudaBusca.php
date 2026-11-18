<?php

namespace Intimai\Servicos\Buscar\CodigoAjuda;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class CodigoAjudaBusca implements ServicoBusca
{
    use Endpoint;

    public function getEndpoint(): string
    {
        return self::CODIGO_AJUDA_ENDPOINT . self::BUSCAR_ENDPOINT;
    }
}
