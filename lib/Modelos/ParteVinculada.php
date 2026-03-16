<?php

namespace Intimai\Modelos;

class ParteVinculada
{
    private string $nome;
    private ?string $participacao;
    public function __construct(string $nome, ?string $participacao = null)
    {
        $this->nome = $nome;
        $this->participacao = $participacao;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getParticipacao(): ?string
    {
        return $this->participacao;
    }
}