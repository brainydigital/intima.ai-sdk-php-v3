<?php

namespace Intimai\Servicos\Cadastrar\Notificacao;

use Intimai\Servicos\Cadastrar\ServicoCadastro;
use Intimai\Servicos\Endpoint;

class NotificacaoWebhookCadastro implements ServicoCadastro
{
    use Endpoint;

    private string|int $tipoAcao;
    private string $verboHttp;
    private string $url;

    public function __construct(string|int $tipoAcao, string $verboHttp, string $url)
    {
        $this->tipoAcao = $tipoAcao;
        $this->verboHttp = $verboHttp;
        $this->url = $url;
    }

    public function getEndpoint(): string
    {
        return self::NOTIFICACAO_ENDPOINT . self::WEBHOOK_ENDPOINT . self::CADASTRAR_ENDPOINT;
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