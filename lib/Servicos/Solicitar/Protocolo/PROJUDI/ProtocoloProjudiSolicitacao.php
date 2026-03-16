<?php

namespace Intimai\Servicos\Solicitar\Protocolo\PROJUDI;

use Exception;
use Intimai\Modelos\Documento;
use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Helpers;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class ProtocoloProjudiSolicitacao implements ServicoSolicitacao
{
    use Endpoint;
    use Helpers;

    private string|int $idAutenticador;
    private string $numeroDoProcesso;
    private string|int $tipoDocumentoMensagemGeral;
    private array $documentos;

    /**
     * @param string|int $idAutenticador
     * @param string $numeroDoProcesso
     * @param string|int $tipoDocumentoMensagemGeral
     * @param Documento[] $documentos
     */
    public function __construct(
        string|int $idAutenticador,
        string     $numeroDoProcesso,
        string|int $tipoDocumentoMensagemGeral,
        array      $documentos = []
    )
    {
        $this->idAutenticador = $idAutenticador;
        $this->numeroDoProcesso = $numeroDoProcesso;
        $this->tipoDocumentoMensagemGeral = $tipoDocumentoMensagemGeral;
        $this->documentos = $documentos;
    }

    public function getEndpoint(): string
    {
        return self::PROJUDI_ENDPOINT . self::PROTOCOLO_ENDPOINT . self::SOLICITAR_ENDPOINT;
    }

    /**
     * @throws Exception
     */
    public function getRequest(): array
    {
        $parametrosParaMultiForm = [
            'numero_processo' => $this->numeroDoProcesso,
            'autenticacao_id' => $this->idAutenticador,
            'tipo_documento_mensagem_geral' => $this->tipoDocumentoMensagemGeral,
        ];

        $this->definirDocumentos($this->documentos, $parametrosParaMultiForm);

        return [
            'headers' => [
                'Accept' => 'application/json',
                'User-Agent' => 'Intimai_SDK/3.0.0',
            ],
            'multipart' => $this->definirMultiPart($parametrosParaMultiForm)
        ];
    }
}