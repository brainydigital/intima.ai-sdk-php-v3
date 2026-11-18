<?php

namespace Intimai\Exceptions;

use Exception;
use GuzzleHttp\Exception\BadResponseException;
use Throwable;

class APIRequestException extends Exception
{
    protected mixed $corpo = null;
    protected array $headers = [];

    public static function daResposta(BadResponseException $exception): static
    {
        $resposta = $exception->getResponse();
        $conteudo = (string) $resposta->getBody();
        $corpo = json_decode($conteudo, true) ?? $conteudo;
        $status = $resposta->getStatusCode();
        $mensagem = is_array($corpo) ? ($corpo['data']['message'] ?? $corpo['message'] ?? null) : null;

        $classe = match (true) {
            $status === 401 && is_string($mensagem) && str_contains($mensagem, '2FA') => DoisFatoresException::class,
            $status === 429 => LimiteDeRequisicoesException::class,
            default => static::class,
        };

        return new $classe($exception->getMessage(), $status, $exception, $corpo, $resposta->getHeaders());
    }

    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null, mixed $corpo = null, array $headers = [])
    {
        parent::__construct($message, $code, $previous);
        $this->corpo = $corpo;
        $this->headers = $headers;
    }

    public function getStatus(): int
    {
        return $this->code;
    }

    public function getCorpo(): mixed
    {
        return $this->corpo;
    }

    public function getMensagem(): string
    {
        if (!is_array($this->corpo)) {
            return $this->message;
        }

        $mensagem = $this->corpo['data']['message'] ?? $this->corpo['message'] ?? $this->corpo['error'] ?? null;

        return is_string($mensagem) ? $mensagem : $this->message;
    }

    public function getErros(): array
    {
        if ($this->code !== 422 || !is_array($this->corpo)) {
            return [];
        }

        return array_filter($this->corpo, 'is_array');
    }

    public function getHeader(string $nome): ?string
    {
        foreach ($this->headers as $chave => $valores) {
            if (strcasecmp($chave, $nome) === 0) {
                return is_array($valores) ? ($valores[0] ?? null) : $valores;
            }
        }

        return null;
    }

    public function toJson(): array
    {
        return [
            'code' => $this->code,
            'error' => $this->corpo
        ];
    }
}
