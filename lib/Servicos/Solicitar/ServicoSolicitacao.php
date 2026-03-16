<?php

namespace Intimai\Servicos\Solicitar;

interface ServicoSolicitacao
{
    public function getEndpoint(): string;
    public function getRequest(): array;
}