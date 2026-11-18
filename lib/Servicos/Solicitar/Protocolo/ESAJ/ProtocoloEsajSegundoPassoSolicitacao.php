<?php

namespace Intimai\Servicos\Solicitar\Protocolo\ESAJ;

use Intimai\Modelos\Documento;
use Intimai\Modelos\ParteVinculada;
use Intimai\Modelos\Peticao;
use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Helpers;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class ProtocoloEsajSegundoPassoSolicitacao implements ServicoSolicitacao
{
    use Endpoint;
    use Helpers;

    private string|int $id;
    private string|int $idClasse;
    private string|int $idCategoria;
    private array $partesVinculadas;
    private Peticao $peticao;
    private array $documentos;

    /**
     * @param string|int $id
     * @param string|int $idClasse
     * @param string|int $idCategoria
     * @param ParteVinculada[] $partesVinculadas
     * @param Peticao $peticao
     * @param Documento[] $documentos
     */
    public function __construct(string|int $id, string|int $idClasse, string|int $idCategoria, array $partesVinculadas, Peticao $peticao, array $documentos = [])
    {
        $this->id = $id;
        $this->idClasse = $idClasse;
        $this->idCategoria = $idCategoria;
        $this->partesVinculadas = $partesVinculadas;
        $this->peticao = $peticao;
        $this->documentos = $documentos;
    }

    public function getEndpoint(): string
    {
        return self::ESAJ_ENDPOINT . self::PROTOCOLO_ENDPOINT . '/' . $this->id . self::SEGUNDA_ETAPA_ENDPOINT;
    }

    public function getRequest(): array
    {
        $parametrosParaMultiForm = [
            'classe_id' => $this->idClasse,
            'categoria_id' => $this->idCategoria,
        ];

        $this->definirPartes($this->partesVinculadas, $parametrosParaMultiForm);

        $this->definirPeticao($this->peticao, $parametrosParaMultiForm);

        $this->definirDocumentos($this->documentos, $parametrosParaMultiForm);

        return [
            'multipart' => $this->definirMultiPart($parametrosParaMultiForm)
        ];
    }
}