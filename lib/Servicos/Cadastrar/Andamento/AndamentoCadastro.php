<?php

namespace Intimai\Servicos\Cadastrar\Andamento;

use Intimai\Servicos\Cadastrar\ServicoCadastro;
use Intimai\Servicos\Endpoint;

class AndamentoCadastro implements ServicoCadastro
{
    use Endpoint;

    private string $numeroDoProcesso;
    private string|int $idAutenticador;

    public function __construct(string|int $idAutenticador, string $numeroDoProcesso)
    {
        $this->idAutenticador = $idAutenticador;
        $this->numeroDoProcesso = $numeroDoProcesso;
    }

    public function getEndpoint(): string
    {
        if (empty($this->id)) {
            return self::ANDAMENTO_ENDPOINT . self::CADASTRAR_ENDPOINT;
        }

        return self::ANDAMENTO_ENDPOINT . '/' . $this->id . self::CADASTRAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'autenticacao_id' => $this->idAutenticador,
                'numero_processo' => $this->numeroDoProcesso
            ]
        ];
    }
}