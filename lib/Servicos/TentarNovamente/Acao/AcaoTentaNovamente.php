<?php

namespace Intimai\Servicos\TentarNovamente\Acao;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\TentarNovamente\ServicoTentaNovamente;

class AcaoTentaNovamente implements ServicoTentaNovamente
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::ACAO_ENDPOINT . '/' . $this->id . self::TENTAR_NOVAMENTE_ENDPOINT;
    }
}