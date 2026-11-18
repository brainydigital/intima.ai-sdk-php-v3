<?php

namespace Intimai\Servicos\Solicitar\Protocolo\EPROC;


use Intimai\Modelos\Documento;
use Intimai\Modelos\ParteVinculada;
use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Helpers;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class ProtocoloEprocSegundoPassoSolicitacao implements ServicoSolicitacao
{
    use Endpoint;
    use Helpers;

    private string|int $id;
    private string|int $tipoDocumentoMensagemGeral;
    private array $partesVinculadas;
    private array $documentos;


    /**
     * @param string|int $id
     * @param string|int $tipoDocumentoMensagemGeral
     * @param ParteVinculada[] $partesVinculadas
     * @param Documento[] $documentos
     */
    public function __construct(
        string|int $id,
        string|int $tipoDocumentoMensagemGeral,
        array      $partesVinculadas,
        array      $documentos = []
    )
    {
        $this->id = $id;
        $this->tipoDocumentoMensagemGeral = $tipoDocumentoMensagemGeral;
        $this->partesVinculadas = $partesVinculadas;
        $this->documentos = $documentos;
    }

    public function getEndpoint(): string
    {
        return self::EPROC_ENDPOINT . self::PROTOCOLO_ENDPOINT . '/' . $this->id . self::SEGUNDA_ETAPA_ENDPOINT;
    }

    public function getRequest(): array
    {
        $parametrosParaMultiForm = [
            'tipo_documento_mensagem_geral' => $this->tipoDocumentoMensagemGeral,
        ];

        $this->definirPartes($this->partesVinculadas, $parametrosParaMultiForm);

        $this->definirDocumentos($this->documentos, $parametrosParaMultiForm);

        return [
            'multipart' => $this->definirMultiPart($parametrosParaMultiForm)
        ];
    }
}