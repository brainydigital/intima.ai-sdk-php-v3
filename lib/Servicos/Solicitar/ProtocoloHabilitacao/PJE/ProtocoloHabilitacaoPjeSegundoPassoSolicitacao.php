<?php

namespace Intimai\Servicos\Solicitar\ProtocoloHabilitacao\PJE;

use Intimai\Modelos\ParteVinculada;
use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Helpers;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class ProtocoloHabilitacaoPjeSegundoPassoSolicitacao implements ServicoSolicitacao
{
    use Endpoint;
    use Helpers;

    private string|int $id;
    private int $tipoSolicitacao;
    private int $tipoDeclaracao;
    private int $polo;
    private array $partesVinculadas;
    private string|int $tipoDocumentoMensagemGeral;
    private ?string $descricao;
    private ?string $mensagemGeral;
    private array $documentos;

    public function __construct(
        string|int $id,
        int        $tipoSolicitacao,
        int        $tipoDeclaracao,
        int        $polo,
        array      $partesVinculadas,
        string|int $tipoDocumentoMensagemGeral,
        ?string    $descricao = null,
        ?string    $mensagemGeral = null,
        array      $documentos = []
    )
    {
        $this->id = $id;
        $this->tipoSolicitacao = $tipoSolicitacao;
        $this->tipoDeclaracao = $tipoDeclaracao;
        $this->polo = $polo;
        $this->partesVinculadas = $partesVinculadas;
        $this->tipoDocumentoMensagemGeral = $tipoDocumentoMensagemGeral;
        $this->descricao = $descricao;
        $this->mensagemGeral = $mensagemGeral;
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
            'descricao' => $this->descricao,
            'mensagem_geral' => $this->mensagemGeral,
        ];

        foreach (array_values($this->partesVinculadas) as $indice => $parte) {
            $parametrosParaMultiForm["partes_vinculadas[$indice]"] = $parte instanceof ParteVinculada ? $parte->getNome() : $parte;
        }

        $this->definirDocumentos($this->documentos, $parametrosParaMultiForm);

        return [
            'multipart' => $this->definirMultiPart($parametrosParaMultiForm)
        ];
    }
}
