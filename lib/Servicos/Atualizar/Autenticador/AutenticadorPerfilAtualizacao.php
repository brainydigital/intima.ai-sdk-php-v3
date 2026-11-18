<?php

namespace Intimai\Servicos\Atualizar\Autenticador;

use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Endpoint;

class AutenticadorPerfilAtualizacao implements ServicoAtualizacao
{
    use Endpoint;

    private string|int $id;
    private ?string $usuarioSigla;
    private ?string $usuarioDescricao;

    public function __construct(string|int $id, ?string $usuarioSigla = null, ?string $usuarioDescricao = null)
    {
        $this->id = $id;
        $this->usuarioSigla = $usuarioSigla;
        $this->usuarioDescricao = $usuarioDescricao;
    }

    public function getEndpoint(): string
    {
        return self::AUTENTICADOR_ENDPOINT . '/' . $this->id . self::ATUALIZAR_PERFIL_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'usuario_sigla' => $this->usuarioSigla,
                'usuario_descricao' => $this->usuarioDescricao,
            ]
        ];
    }
}
