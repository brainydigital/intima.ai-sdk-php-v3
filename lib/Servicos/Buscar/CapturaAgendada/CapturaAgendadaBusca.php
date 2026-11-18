<?php

namespace Intimai\Servicos\Buscar\CapturaAgendada;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class CapturaAgendadaBusca implements ServicoBusca
{
    use Endpoint;

    private string|int|null $id;

    public function __construct(string|int|null $id = null)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        if (empty($this->id)) {
            return self::CAPTURA_AGENDADA_ENDPOINT . self::BUSCAR_ENDPOINT;
        }

        return self::CAPTURA_AGENDADA_ENDPOINT . '/' . $this->id . self::BUSCAR_ENDPOINT;
    }
}
