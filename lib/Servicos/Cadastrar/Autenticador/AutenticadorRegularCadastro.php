<?php

namespace Intimai\Servicos\Cadastrar\Autenticador;

use Intimai\Servicos\Cadastrar\ServicoCadastro;
use Intimai\Servicos\Endpoint;

class AutenticadorRegularCadastro implements ServicoCadastro
{
    use Endpoint;

    private string|int $idTribunal;
    private array $oab;
    private string $usuario;
    private string $senha;

    public function __construct(string|int $idTribunal, array $oab, string $usuario, string $senha)
    {
        $this->idTribunal = $idTribunal;
        $this->oab = $oab;
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    public function getEndpoint(): string
    {
        return self::AUTENTICADOR_ENDPOINT . self::REGULAR_ENDPOINT . self::CADASTRAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'tribunal_id' => $this->idTribunal,
                'usuario' => $this->usuario,
                'senha' => $this->senha,
                'oab_numero' => $this->oab['numero'],
                'oab_letra' => $this->oab['letra'] ?? '',
                'oab_uf' => $this->oab['uf'],
            ]
        ];
    }
}