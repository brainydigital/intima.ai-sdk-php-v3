<?php

namespace Intimai\Servicos\Solicitar\Protocolo\TJRJ;

use Intimai\Modelos\Documento;
use Intimai\Modelos\ParteVinculada;
use Intimai\Modelos\Peticao;
use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Helpers;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class ProtocoloTjrjSegundoPassoSolicitacao implements ServicoSolicitacao
{
    use Endpoint;
    use Helpers;

    private string|int $id;
    private string|int $idClasse;
    private array $partesVinculadas;
    private Peticao $peticao;
    private array $documentos;
    private string|int|null $idCategoria;

    /**
     * @param string|int $id
     * @param string|int $idClasse
     * @param ParteVinculada[] $partesVinculadas
     * @param Peticao $peticao
     * @param Documento[] $documentos
     */
    public function __construct(string|int $id, string|int $idClasse, array $partesVinculadas, Peticao $peticao, array $documentos = [], string|int|null $idCategoria = null)
    {
        $this->id = $id;
        $this->idClasse = $idClasse;
        $this->partesVinculadas = $partesVinculadas;
        $this->peticao = $peticao;
        $this->documentos = $documentos;
        $this->idCategoria = $idCategoria;
    }

    public function getEndpoint(): string
    {
        return self::TJRJ_ENDPOINT . self::PROTOCOLO_ENDPOINT . '/' . $this->id . self::SEGUNDA_ETAPA_ENDPOINT;
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