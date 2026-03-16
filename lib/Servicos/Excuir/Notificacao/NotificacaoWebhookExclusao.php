<?php

namespace Intimai\Servicos\Excuir\Notificacao;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Excuir\ServicoExclusao;

class NotificacaoWebhookExclusao implements ServicoExclusao
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::NOTIFICACAO_ENDPOINT . self::WEBHOOK_ENDPOINT . '/' . $this->id . self::EXCLUIR_ENDPOINT;
    }
}