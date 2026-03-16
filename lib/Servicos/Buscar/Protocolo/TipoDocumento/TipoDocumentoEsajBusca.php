<?php

namespace Intimai\Servicos\Buscar\Protocolo\TipoDocumento;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class TipoDocumentoEsajBusca implements ServicoBusca
{
    use Endpoint;

    private string|int $idProtocolo;
    private string|int|null $idClasse;

    public function __construct(string|int $idProtocolo, string|int $idClasse = null)
    {
        $this->idProtocolo = $idProtocolo;
        $this->idClasse = $idClasse;
    }

    public function getEndpoint(): string
    {
        if (empty($this->idClasse)) {
            return self::ESAJ_ENDPOINT . self::PROTOCOLO_ENDPOINT . '/' . $this->idProtocolo . self::TIPOS_DOCUMENTO_ENDPOINT;
        }

        return self::ESAJ_ENDPOINT . self::PROTOCOLO_ENDPOINT . '/' . $this->idProtocolo . self::TIPOS_DOCUMENTO_ENDPOINT . '/' . $this->idClasse;
    }
}