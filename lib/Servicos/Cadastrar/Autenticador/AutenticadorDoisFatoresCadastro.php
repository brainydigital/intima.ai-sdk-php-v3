<?php

namespace Intimai\Servicos\Cadastrar\Autenticador;

use Intimai\Servicos\Cadastrar\ServicoCadastro;
use Intimai\Servicos\Endpoint;

class AutenticadorDoisFatoresCadastro implements ServicoCadastro
{
    use Endpoint;

    private string|int|array $ids;
    private string $secret;

    public function __construct(string|int|array $ids, string $secret)
    {
        $this->ids = $ids;
        $this->secret = $secret;
    }

    public function getEndpoint(): string
    {
        $ids = is_array($this->ids) ? implode(',', $this->ids) : $this->ids;

        return self::AUTENTICADOR_ENDPOINT . '/' . $ids . self::DOIS_FATORES_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'secret' => $this->secret,
            ]
        ];
    }
}
