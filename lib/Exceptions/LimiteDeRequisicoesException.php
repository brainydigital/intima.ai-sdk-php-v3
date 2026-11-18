<?php

namespace Intimai\Exceptions;

class LimiteDeRequisicoesException extends APIRequestException
{
    public function getRetryAfter(): ?int
    {
        $valor = $this->getHeader('Retry-After');

        return is_numeric($valor) ? (int) $valor : null;
    }
}
