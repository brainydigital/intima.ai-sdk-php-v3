<?php

namespace Intimai\Servicos\Atualizar\Autenticador;

use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Endpoint;

class AutenticadorAtivarCapturaIntimacaoAtualizacao implements ServicoAtualizacao
{
    use Endpoint;

    private string|int $id;
    private string|array $abas;
    private string|array $diasDeCaptura;
    private string|array $horariosDeCaptura;
    private bool|int $capturarProcuradorias;

    public function __construct(
        string|int $id,
        string|array $abas,
        string|array $diasDeCaptura,
        string|array $horariosDeCaptura,
        bool|int $capturarProcuradorias = false
    )
    {
        $this->id = $id;
        $this->abas = $abas;
        $this->diasDeCaptura = $diasDeCaptura;
        $this->horariosDeCaptura = $horariosDeCaptura;
        $this->capturarProcuradorias = $capturarProcuradorias;
    }

    public function getEndpoint(): string
    {
        return self::AUTENTICADOR_ENDPOINT . "/$this->id/ativar-captura-intimacao";
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'abas' => $this->abas,
                'dias_de_captura' => $this->diasDeCaptura,
                'horarios_de_captura' => $this->horariosDeCaptura,
                'capturar_procuradorias' => $this->capturarProcuradorias,
            ]
        ];
    }
}