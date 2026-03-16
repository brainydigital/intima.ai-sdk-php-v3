<?php

namespace Intimai\Servicos\Atualizar\Intimacao;

use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Endpoint;

class IntimacaoMarcarComoRevisadaAtualizacao implements ServicoAtualizacao
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id) {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::INTIMACAO_ENDPOINT . '/' . $this->id . self::MARCAR_COMO_REVISADA_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [];
    }
}