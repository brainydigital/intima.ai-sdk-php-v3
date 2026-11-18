<?php

namespace Intimai\Servicos\SolicitarCadastro\Certificado;

use Exception;
use Intimai\Modelos\Certificado;
use Intimai\Servicos\Endpoint;
use Intimai\Servicos\SolicitarCadastro\ServicoSolicitacaoCadastro;

class CertificadoSolicitacaoCadastro implements ServicoSolicitacaoCadastro
{
    use Endpoint;
    private Certificado $certificado;

    public function __construct(Certificado $certificado)
    {
        $this->certificado = $certificado;
    }

    public function getEndpoint(): string
    {
        return self::CERTIFICADO_ENDPOINT . self::SOLICITAR_CADASTRO_ENDPOINT;
    }

    /**
     * @throws Exception
     */
    public function getRequest(): array
    {
        return [
            'multipart' => $this->certificado->emArray()
        ];
    }
}