<?php

namespace Intimai\Servicos\SolicitarExclusao\Certificado;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\SolicitarExclusao\ServicoSolicitacaoExclusao;

class CertificadoSolicitacaoExclusao implements ServicoSolicitacaoExclusao
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::CERTIFICADO_ENDPOINT . "/" . $this->id . self::SOLICITAR_EXCLUSAO_ENDPOINT;
    }
}