<?php

namespace Intimai\Servicos\Buscar\Transacao;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class TransacaoHistoricoBusca implements ServicoBusca
{
    use Endpoint;

    public function getEndpoint(): string
    {
        return self::TRANSACAO_ENDPOINT . self::HISTORICO_ENDPOINT;
    }
}