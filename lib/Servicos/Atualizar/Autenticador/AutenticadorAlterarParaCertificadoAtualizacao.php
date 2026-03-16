<?php

namespace Intimai\Servicos\Atualizar\Autenticador;

use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Endpoint;

class AutenticadorAlterarParaCertificadoAtualizacao implements ServicoAtualizacao
{
    use Endpoint;

    private string|int $id;
    private string|int $idCertificado;

    public function __construct(string|int $id, string|int $idCertificado)
    {
        $this->id = $id;
        $this->idCertificado = $idCertificado;
    }

    public function getEndpoint(): string
    {
        return self::AUTENTICADOR_ENDPOINT . self::CERTIFICADO_ENDPOINT . '/' . $this->id . self::ALTERAR_PARA_CERTIFICADO_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'certificado_id' => $this->idCertificado,
            ]
        ];
    }
}