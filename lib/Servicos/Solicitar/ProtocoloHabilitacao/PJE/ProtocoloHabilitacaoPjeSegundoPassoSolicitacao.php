<?php

namespace Intimai\Servicos\Solicitar\ProtocoloHabilitacao\PJE;

use Intimai\Modelos\Documento;
use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Helpers;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;
use Intimai\Utilidades\Polo;
use Intimai\Utilidades\TipoDeclaracao;
use Intimai\Utilidades\TipoSolicitacao;

class ProtocoloHabilitacaoPjeSegundoPassoSolicitacao implements ServicoSolicitacao
{
    use Endpoint;
    use Helpers;

    private string|int $id;
    private TipoSolicitacao $tipoSolicitacao;
    private TipoDeclaracao $tipoDeclaracao;
    private Polo $polo;
    private array $partesVinculadas;
    private string|int $tipoDocumentoMensagemGeral;
    private array $documentos;

    /**
     * @param string|int $id
     * @param TipoSolicitacao $tipoSolicitacao
     * @param TipoDeclaracao $tipoDeclaracao
     * @param Polo $polo
     * @param array $partesVinculadas
     * @param string|int $tipoDocumentoMensagemGeral
     * @param Documento[] $documentos
     */
    public function __construct(
        string|int      $id,
        TipoSolicitacao $tipoSolicitacao,
        TipoDeclaracao  $tipoDeclaracao,
        Polo            $polo,
        array           $partesVinculadas,
        string|int      $tipoDocumentoMensagemGeral,
        array           $documentos = []
    )
    {
        $this->id = $id;
        $this->tipoSolicitacao = $tipoSolicitacao;
        $this->tipoDeclaracao = $tipoDeclaracao;
        $this->polo = $polo;
        $this->partesVinculadas = $partesVinculadas;
        $this->tipoDocumentoMensagemGeral = $tipoDocumentoMensagemGeral;
        $this->documentos = $documentos;
    }

    public function getEndpoint(): string
    {
        return self::PJE_ENDPOINT . self::PROTOCOLO_HABILITACAO_ENDPOINT . '/' . $this->id . self::SEGUNDA_ETAPA_ENDPOINT;
    }

    public function getRequest(): array
    {
        $parametrosParaMultiForm = [
            'tipo_solicitacao' => $this->tipoSolicitacao,
            'tipo_declaracao' => $this->tipoDeclaracao,
            'polo' => $this->polo,
            'tipo_documento_mensagem_geral' => $this->tipoDocumentoMensagemGeral,
        ];

        $this->definirPartes($this->partesVinculadas, $parametrosParaMultiForm);

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