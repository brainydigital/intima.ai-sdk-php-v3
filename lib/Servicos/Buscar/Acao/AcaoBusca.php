<?php

namespace Intimai\Servicos\Buscar\Acao;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class AcaoBusca implements ServicoBusca
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
            return self::ACAO_ENDPOINT . self::BUSCAR_ENDPOINT;
        }

        return self::ACAO_ENDPOINT . '/' . $this->id . self::BUSCAR_ENDPOINT;
    }
}