<?php

namespace Intimai\Servicos\Buscar\Tribunal;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class TribunalBusca implements ServicoBusca
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
            return self::TRIBUNAL_ENDPOINT . self::BUSCAR_ENDPOINT;
        }

        return self::TRIBUNAL_ENDPOINT . '/' . $this->id . self::BUSCAR_ENDPOINT;
    }
}