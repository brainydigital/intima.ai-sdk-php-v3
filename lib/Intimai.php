<?php

namespace Intimai;

use Intimai\API\API;
use Intimai\Servicos\Servicos;

class Intimai
{
    private API $api;
    public Servicos $servicos;

    public function __construct(string $apiToken, array $opcoes = [])
    {
        $this->api = new API($apiToken, $opcoes);
        $this->servicos = new Servicos($this->api);
    }
}