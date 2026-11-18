<?php

namespace Intimai\Servicos\Solicitar\Protocolo\PJE;

use Exception;
use Intimai\Modelos\Documento;
use Intimai\Modelos\Peticao;
use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Helpers;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class ProtocoloPjeSolicitacao implements ServicoSolicitacao
{
    use Endpoint;
    use Helpers;

    private string|int $idAutenticador;
    private string $numeroDoProcesso;
    private string|int $tipoDocumentoMensagemGeral;
    private ?Peticao $peticao;
    private array $documentos;

    /**
     * @param string|int $idAutenticador
     * @param string $numeroDoProcesso
     * @param string|int $tipoDocumentoMensagemGeral
     * @param Peticao|null $peticao
     * @param Documento[] $documentos
     */
    public function __construct(
        string|int $idAutenticador,
        string     $numeroDoProcesso,
        string|int $tipoDocumentoMensagemGeral,
        ?Peticao   $peticao = null,
        array      $documentos = []
    )
    {
        $this->idAutenticador = $idAutenticador;
        $this->numeroDoProcesso = $numeroDoProcesso;
        $this->tipoDocumentoMensagemGeral = $tipoDocumentoMensagemGeral;
        $this->peticao = $peticao;
        $this->documentos = $documentos;
    }

    public function getEndpoint(): string
    {
        return self::PJE_ENDPOINT . self::PROTOCOLO_ENDPOINT . self::SOLICITAR_ENDPOINT;
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

        $this->definirPeticao($this->peticao, $parametrosParaMultiForm);

        $this->definirDocumentos($this->documentos, $parametrosParaMultiForm);

        return [
            'multipart' => $this->definirMultiPart($parametrosParaMultiForm)
        ];
    }
}