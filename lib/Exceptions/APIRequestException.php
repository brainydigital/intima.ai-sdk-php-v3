<?php

namespace Intimai\Exceptions;

use Exception;

class APIRequestException extends Exception
{
    public function toJson(): array
    {
        return [
            'code' => $this->code,
            'error' => json_decode($this->message, true)
        ];
    }
}