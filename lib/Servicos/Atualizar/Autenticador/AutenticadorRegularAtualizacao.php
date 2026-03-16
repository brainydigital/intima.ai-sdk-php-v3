<?php

namespace Intimai\Servicos\Atualizar\Autenticador;

use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Endpoint;

class AutenticadorRegularAtualizacao implements ServicoAtualizacao
{
    use Endpoint;

    private string|int $id;
    private ?string $usuario;
    private ?string $senha;

    public function __construct(string|int $id, string $usuario = null, string $senha = null)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    public function getEndpoint(): string
    {
        return self::AUTENTICADOR_ENDPOINT . self::REGULAR_ENDPOINT . '/' . $this->id . self::ATUALIZAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'usuario' => $this->usuario,
                'senha' => $this->senha]
        ];
    }
}