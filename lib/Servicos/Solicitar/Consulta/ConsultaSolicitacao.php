<?php

namespace Intimai\Servicos\Solicitar\Consulta;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class ConsultaSolicitacao implements ServicoSolicitacao
{
    use Endpoint;

    private string|int $idAutenticador;
    private string $numeroDoProcesso;
    private string $nomeParte;
    private string $nomeRepresentante;
    private array $oab;
    private string $numeroDocumentoParte;

    public function __construct(
        string|int $idAutenticador,
        string     $numeroDoProcesso = '',
        string     $nomeParte = '',
        string     $nomeRepresentante = '',
        array      $oab = [],
        string     $numeroDocumentoParte = ''
    )
    {
        $this->idAutenticador = $idAutenticador;
        $this->numeroDoProcesso = $numeroDoProcesso;
        $this->nomeParte = $nomeParte;
        $this->nomeRepresentante = $nomeRepresentante;
        $this->oab = $oab;
        $this->numeroDocumentoParte = $numeroDocumentoParte;
    }

    public function getEndpoint(): string
    {
        return self::CONSULTA_ENDPOINT . self::SOLICITAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'autenticacao_id' => $this->idAutenticador,
                'numero_processo' => $this->numeroDoProcesso,
                'nome_parte' => $this->nomeParte,
                'nome_representante' => $this->nomeRepresentante,
                'oab' => $this->oab,
                'numero_documento_parte' => $this->numeroDocumentoParte,
            ]
        ];
    }
}