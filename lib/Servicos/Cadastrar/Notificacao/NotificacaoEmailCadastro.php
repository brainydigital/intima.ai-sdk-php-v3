<?php

namespace Intimai\Servicos\Cadastrar\Notificacao;

use Intimai\Servicos\Cadastrar\ServicoCadastro;
use Intimai\Servicos\Endpoint;

class NotificacaoEmailCadastro implements ServicoCadastro
{
    use Endpoint;

    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEndpoint(): string
    {
        return self::NOTIFICACAO_ENDPOINT . self::EMAIL_ENDPOINT . self::CADASTRAR_ENDPOINT;
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