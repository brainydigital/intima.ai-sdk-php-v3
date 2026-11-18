<?php

namespace Intimai\Servicos\Resultado\Andamento;

use Intimai\Servicos\Endpoint;
use Intimai\Servicos\Resultado\ServicoResultado;

class AndamentoResultado implements ServicoResultado
{
    use Endpoint;

    private string|int $id;
    private string|int|null $idProcesso;

    public function __construct(string|int $id, string|int|null $idProcesso = null)
    {
        $this->id = $id;
        $this->idProcesso = $idProcesso;
    }

    public function getEndpoint(): string
    {
        if (empty($this->idProcesso)) {
            return self::ANDAMENTO_ENDPOINT . '/' . $this->id . self::RESULTADO_ENDPOINT;
        }

        return self::ANDAMENTO_ENDPOINT . '/' . $this->id . self::RESULTADO_ENDPOINT . '/' . $this->idProcesso;
    }
}