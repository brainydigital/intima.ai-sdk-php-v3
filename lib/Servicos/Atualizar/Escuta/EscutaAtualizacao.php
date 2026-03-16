<?php

namespace Intimai\Servicos\Atualizar\Escuta;

use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Endpoint;

class EscutaAtualizacao implements ServicoAtualizacao
{
    use Endpoint;

    private string|int $id;
    private array|string $diasDeCaptura;
    private array|string $horariosDeCaptura;

    public function __construct(string|int $id, array|string $diasDeCaptura, array|string $horariosDeCaptura) {
        $this->id = $id;
        $this->diasDeCaptura = $diasDeCaptura;
        $this->horariosDeCaptura = $horariosDeCaptura;
    }

    public function getEndpoint(): string
    {
        return self::ESCUTA_ENDPOINT . '/' . $this->id . self::ATUALIZAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'dias_de_captura' => $this->diasDeCaptura,
                'horarios_de_captura' => $this->horariosDeCaptura
            ]
        ];
    }
}