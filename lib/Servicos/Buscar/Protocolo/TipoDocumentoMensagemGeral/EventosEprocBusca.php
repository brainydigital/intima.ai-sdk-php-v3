<?php

namespace Intimai\Servicos\Buscar\Protocolo\TipoDocumentoMensagemGeral;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class EventosEprocBusca implements ServicoBusca
{
    use Endpoint;

    private string|int $idProtocolo;

    public function __construct(string|int $idProtocolo)
    {
        $this->idProtocolo = $idProtocolo;
    }

    public function getEndpoint(): string
    {
        return self::EPROC_ENDPOINT . self::PROTOCOLO_ENDPOINT . '/' . $this->idProtocolo . self::EVENTOS_ENDPOINT;
    }
}