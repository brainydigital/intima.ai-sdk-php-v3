<?php

namespace Intimai\Servicos\Buscar\ProtocoloHabilitacao\TipoDocumentoMensagemGeral;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class TipoDocumentoMensagemGeralPjeBusca implements ServicoBusca
{
    use Endpoint;

    private string|int $idProtocoloHabilitacao;

    public function __construct(string|int $idProtocoloHabilitacao)
    {
        $this->idProtocoloHabilitacao = $idProtocoloHabilitacao;
    }

    public function getEndpoint(): string
    {
        return self::PJE_ENDPOINT . self::PROTOCOLO_HABILITACAO_ENDPOINT . '/' . $this->idProtocoloHabilitacao . self::TIPOS_DOCUMENTO_MENSAGEM_GERAL_ENDPOINT;
    }
}