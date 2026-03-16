<?php

namespace Intimai\Servicos\Atualizar\Notificacao;

use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Endpoint;

class NotificacaoWebhookAtualizacao implements ServicoAtualizacao
{
    use Endpoint;

    private string|int $id;
    private string $tipoAcao;
    private string $verboHttp;
    private string $url;

    public function __construct(string $id, string $tipoAcao, string $verboHttp, string $url)
    {
        $this->id = $id;
        $this->tipoAcao = $tipoAcao;
        $this->verboHttp = $verboHttp;
        $this->url = $url;
    }

    public function getEndpoint(): string
    {
        return self::NOTIFICACAO_ENDPOINT . self::WEBHOOK_ENDPOINT . '/' . $this->id . self::ATUALIZAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'tipo_acao' => $this->tipoAcao,
                'verbo_http' => $this->verboHttp,
                'url' => $this->url,
            ]
        ];
    }
}