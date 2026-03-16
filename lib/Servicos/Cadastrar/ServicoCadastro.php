<?php

namespace Intimai\Servicos\Cadastrar;

interface ServicoCadastro
{
    public function getEndpoint(): string;
    public function getRequest(): array;
}