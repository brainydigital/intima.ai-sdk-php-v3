<?php

namespace Intimai\Servicos\SolicitarAtualizacao;

interface ServicoSolicitaAtualizacao
{
    public function getEndpoint(): string;
    public function getRequest(): array;
}