<?php

namespace Intimai\Servicos\Buscar\Notificacao;

use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Endpoint;

class NotificacaoWebhookBusca implements ServicoBusca
{
    use Endpoint;

    private string|int|null $id;

    public function __construct(?string $id = null)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        if (empty($this->id)) {
            return self::NOTIFICACAO_ENDPOINT . self::WEBHOOK_ENDPOINT . self::BUSCAR_ENDPOINT;
        }

        return self::NOTIFICACAO_ENDPOINT . self::WEBHOOK_ENDPOINT .  '/' . $this->id . self::BUSCAR_ENDPOINT;
    }
}