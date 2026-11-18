<?php

namespace Intimai\Servicos\Buscar\ProtocoloHabilitacao;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class ProtocoloHabilitacaoBusca implements ServicoBusca
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
            return self::PROTOCOLO_HABILITACAO_ENDPOINT . self::BUSCAR_ENDPOINT;
        }

        return self::PROTOCOLO_HABILITACAO_ENDPOINT . '/' . $this->id . self::BUSCAR_ENDPOINT;
    }
}