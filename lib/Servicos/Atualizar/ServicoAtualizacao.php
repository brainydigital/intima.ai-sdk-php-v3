<?php

namespace Intimai\Servicos\Atualizar;

interface ServicoAtualizacao
{
    public function getEndpoint(): string;
    public function getRequest(): array;
}