<?php

namespace Intimai\Servicos\Atualizar\Autenticador;

use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Endpoint;

class AutenticadorAlterarParaRegularAtualizacao implements ServicoAtualizacao
{
    use Endpoint;

    private string|int $id;
    private string $usuario;
    private string $senha;
    private string|int|null $idCertificado;

    public function __construct(string|int $id, string $usuario, string $senha, string|int|null $idCertificado = null)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->idCertificado = $idCertificado;
    }

    public function getEndpoint(): string
    {
        return self::AUTENTICADOR_ENDPOINT . self::REGULAR_ENDPOINT . '/'  . $this->id . self::ALTERAR_PARA_REGULAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'usuario' => $this->usuario,
                'senha' => $this->senha,
                'certificado_id' => $this->idCertificado,
            ]
        ];
    }
}