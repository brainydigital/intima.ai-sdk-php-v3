<?php

namespace Intimai\Servicos\Buscar\Usuario;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class UsuarioBusca implements ServicoBusca
{
    use Endpoint;

    public function getEndpoint(): string
    {
        return self::USUARIO_ENDPOINT . self::BUSCAR_ENDPOINT;
    }
}