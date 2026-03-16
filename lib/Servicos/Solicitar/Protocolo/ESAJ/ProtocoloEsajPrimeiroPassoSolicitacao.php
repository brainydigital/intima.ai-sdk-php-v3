<?php

namespace Intimai\Servicos\Solicitar\Protocolo\ESAJ;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;

class ProtocoloEsajPrimeiroPassoSolicitacao implements ServicoSolicitacao
{
    use Endpoint;

    private string|int $idAutenticador;
    private string $numeroDoProcesso;

    public function __construct(string|int $idAutenticador, string $numeroDoProcesso) {
        $this->idAutenticador = $idAutenticador;
        $this->numeroDoProcesso = $numeroDoProcesso;
    }

    public function getEndpoint(): string
    {
        return self::ESAJ_ENDPOINT . self::PROTOCOLO_ENDPOINT . self::PRIMEIRA_ETAPA_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'autenticacao_id' => $this->idAutenticador,
                'numero_processo' => $this->numeroDoProcesso
            ]
        ];
    }
}