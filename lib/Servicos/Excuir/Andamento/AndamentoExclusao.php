<?php

namespace Intimai\Servicos\Excuir\Andamento;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Excuir\ServicoExclusao;

class AndamentoExclusao implements ServicoExclusao
{
    use Endpoint;

    private string|int $id;

    public function __construct(string|int $id)
    {
        $this->id = $id;
    }

    public function getEndpoint(): string
    {
        return self::ANDAMENTO_ENDPOINT . '/' . $this->id . self::EXCLUIR_ENDPOINT;
    }
}