<?php

namespace Intimai\Servicos\SolicitarCadastro;

interface ServicoSolicitacaoCadastro
{
    public function getEndpoint(): string;
    public function getRequest(): array;
}