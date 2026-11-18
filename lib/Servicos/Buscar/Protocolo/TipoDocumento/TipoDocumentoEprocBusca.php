<?php

namespace Intimai\Servicos\Buscar\Protocolo\TipoDocumento;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class TipoDocumentoEprocBusca implements ServicoBusca
{
    use Endpoint;

    private string|int $idProtocolo;
    private string|int|null $idEvento;

    public function __construct(string|int $idProtocolo, string|int|null $idEvento = null)
    {
        $this->idProtocolo = $idProtocolo;
        $this->idEvento = $idEvento;
    }

    public function getEndpoint(): string
    {
        if (empty($this->idEvento)) {
            return self::EPROC_ENDPOINT . self::PROTOCOLO_ENDPOINT . '/' . $this->idProtocolo . self::TIPOS_DOCUMENTO_ENDPOINT;
        }

        return self::EPROC_ENDPOINT . self::PROTOCOLO_ENDPOINT . '/' . $this->idProtocolo . self::TIPOS_DOCUMENTO_ENDPOINT . '/' . $this->idEvento;
    }
}