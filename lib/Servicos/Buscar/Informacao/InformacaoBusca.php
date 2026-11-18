<?php

namespace Intimai\Servicos\Buscar\Informacao;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class InformacaoBusca implements ServicoBusca
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
            return self::INFORMACAO_ENDPOINT . self::BUSCAR_ENDPOINT;
        }

        return self::INFORMACAO_ENDPOINT . '/' . $this->id . self::BUSCAR_ENDPOINT;
    }
}