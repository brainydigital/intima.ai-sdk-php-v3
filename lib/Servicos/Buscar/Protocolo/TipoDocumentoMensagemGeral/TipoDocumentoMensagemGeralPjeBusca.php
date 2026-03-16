<?php

namespace Intimai\Servicos\Buscar\Protocolo\TipoDocumentoMensagemGeral;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class TipoDocumentoMensagemGeralPjeBusca implements ServicoBusca
{
    use Endpoint;

    private string|int $idAutenticador;

    public function __construct(string|int $idAutenticador)
    {
        $this->idAutenticador = $idAutenticador;
    }

    public function getEndpoint(): string
    {
        return self::PJE_ENDPOINT . self::PROTOCOLO_ENDPOINT . '/' . $this->idAutenticador . self::TIPOS_DOCUMENTO_MENSAGEM_GERAL_ENDPOINT;
    }
}