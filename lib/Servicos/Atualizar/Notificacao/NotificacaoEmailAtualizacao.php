<?php

namespace Intimai\Servicos\Atualizar\Notificacao;

use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Endpoint;

class NotificacaoEmailAtualizacao implements ServicoAtualizacao
{
    use Endpoint;

    private string|int $id;
    private string $email;

    public function __construct(string $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    public function getEndpoint(): string
    {
        return self::NOTIFICACAO_ENDPOINT . self::EMAIL_ENDPOINT . '/' . $this->id . self::ATUALIZAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'email' => $this->email,
            ]
        ];
    }
}