<?php

namespace Intimai\Servicos\Atualizar\Autenticador;

use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Endpoint;

class AutenticadorDesativarCapturaIntimacaoAtualizacao implements ServicoAtualizacao
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::AUTENTICADOR_ENDPOINT . "/$this->id/desativar-captura-intimacao";
    }

    public function getRequest(): array
    {
        return [];
    }
}