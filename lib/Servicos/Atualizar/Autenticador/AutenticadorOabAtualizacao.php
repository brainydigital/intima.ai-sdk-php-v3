<?php

namespace Intimai\Servicos\Atualizar\Autenticador;

use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Endpoint;

class AutenticadorOabAtualizacao implements ServicoAtualizacao
{
    use Endpoint;
    private string|int $id;
    private array $oab;

    public function __construct(string|int $id, array $oab) {
        $this->id = $id;
        $this->oab = $oab;
    }

    public function getEndpoint(): string
    {
        return self::AUTENTICADOR_ENDPOINT . '/' . $this->id . self::ATUALIZAR_ENDPOINT . '-oab';
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'oab_numero' => $this->oab['numero'],
                'oab_letra' => $this->oab['letra'] ?? '',
                'oab_uf' => $this->oab['uf'],
            ]
        ];
    }
}