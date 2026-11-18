<?php

namespace Intimai\Servicos\Buscar\ConsultaPreAnalise;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class ConsultaPreAnaliseBusca implements ServicoBusca
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
            return self::CONSULTA_PRE_ANALISE_ENDPOINT . self::BUSCAR_ENDPOINT;
        }

        return self::CONSULTA_PRE_ANALISE_ENDPOINT . '/' . $this->id . self::BUSCAR_ENDPOINT;
    }
}