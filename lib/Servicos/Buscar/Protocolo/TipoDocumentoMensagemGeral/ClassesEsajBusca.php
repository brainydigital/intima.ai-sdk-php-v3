<?php

namespace Intimai\Servicos\Buscar\Protocolo\TipoDocumentoMensagemGeral;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class ClassesEsajBusca implements ServicoBusca
{
    use Endpoint;

    private string|int $idProtocolo;

    public function __construct(string|int $idProtocolo)
    {
        $this->idProtocolo = $idProtocolo;
    }

    public function getEndpoint(): string
    {
        return self::ESAJ_ENDPOINT . self::PROTOCOLO_ENDPOINT . '/' . $this->idProtocolo . self::CLASSES_ENDPOINT;
    }
}