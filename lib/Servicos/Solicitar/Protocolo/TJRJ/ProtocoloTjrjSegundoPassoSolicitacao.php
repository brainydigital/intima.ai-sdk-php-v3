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

    /**
     * @param string|int $id
     * @param string|int $idClasse
     * @param ParteVinculada[] $partesVinculadas
     * @param Peticao $peticao
     * @param Documento[] $documentos
     */
    public function __construct(string|int $id, string|int $idClasse, array $partesVinculadas, Peticao $peticao, array $documentos = [])
    {
        $this->id = $id;
        $this->idClasse = $idClasse;
        $this->partesVinculadas = $partesVinculadas;
        $this->peticao = $peticao;
        $this->documentos = $documentos;
    }

    public function getEndpoint(): string
    {
        return self::TJRJ_ENDPOINT . self::PROTOCOLO_ENDPOINT . '/' . $this->id . self::SEGUNDA_ETAPA_ENDPOINT;
    }

    public function getRequest(): array
    {
        $parametrosParaMultiForm = [
            'classe_id' => $this->idClasse,
        ];

        $this->definirPartes($this->partesVinculadas, $parametrosParaMultiForm);

        $this->definirPeticao($this->peticao, $parametrosParaMultiForm);

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