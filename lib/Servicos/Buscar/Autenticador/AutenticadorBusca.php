<?php

namespace Intimai\Servicos\Buscar\Autenticador;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class AutenticadorBusca implements ServicoBusca
{
    use Endpoint;

    private string|int|null $id;

    public function __construct(string|int $id = null)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        if (empty($this->id)) {
            return self::AUTENTICADOR_ENDPOINT . self::BUSCAR_ENDPOINT;
        }

        return self::AUTENTICADOR_ENDPOINT . '/' . $this->id . self::BUSCAR_ENDPOINT;
    }
}