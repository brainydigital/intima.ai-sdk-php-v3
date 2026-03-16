<?php

namespace Intimai\Servicos\SolicitarAtualizacao\Certificado;

use Intimai\Modelos\Certificado;
use Intimai\Servicos\Endpoint;
use Intimai\Servicos\SolicitarAtualizacao\ServicoSolicitaAtualizacao;

class CertificadoSolicitaAtualizacao implements ServicoSolicitaAtualizacao
{
    use Endpoint;

    private string|int $id;
    private Certificado $certificado;

    public function __construct(string|int $id, Certificado $certificado)
    {
        $this->id = $id;
        $this->certificado = $certificado;
    }

    public function getEndpoint(): string
    {
        return self::CERTIFICADO_ENDPOINT . "/" . $this->id . self::SOLICITAR_ATUALIZACAO_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'headers' => [
                'Accept' => 'application/json',
                'User-Agent' => 'Intimai_SDK/3.0.0',
            ],
            'multipart' => $this->certificado->emArray()
        ];
    }
}