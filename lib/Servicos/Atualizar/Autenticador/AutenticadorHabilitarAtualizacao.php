<?php

namespace Intimai\Servicos\Atualizar\Autenticador;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Atualizar\ServicoAtualizacao;

class AutenticadorHabilitarAtualizacao implements ServicoAtualizacao
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::AUTENTICADOR_ENDPOINT . '/' . $this->id . self::HABILITAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [];
    }
}
