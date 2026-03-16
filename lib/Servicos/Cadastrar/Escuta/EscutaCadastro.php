<?php

namespace Intimai\Servicos\Cadastrar\Escuta;

use Intimai\Servicos\Cadastrar\ServicoCadastro;
use Intimai\Servicos\Endpoint;
use Intimai\Utilidades\Dia;
use Intimai\Utilidades\Horario;

class EscutaCadastro implements ServicoCadastro
{
    use Endpoint;
    
    private string|int $idAutenticador;
    private string $numeroDoProcesso;
    private array|string $diasDeCaptura;
    private array|string $horariosDeCaptura;

    /**
     * @param string|int $idAutenticador
     * @param string $numeroDoProcesso
     * @param Dia[]|string $diasDeCaptura
     * @param Horario[]|string $horariosDeCaptura
     */
    public function __construct(string|int $idAutenticador, string $numeroDoProcesso, array|string $diasDeCaptura, array|string $horariosDeCaptura)
    {
        $this->idAutenticador = $idAutenticador;
        $this->numeroDoProcesso = $numeroDoProcesso;
        $this->diasDeCaptura = $diasDeCaptura;
        $this->horariosDeCaptura = $horariosDeCaptura;
    }

    public function getEndpoint(): string
    {
        if (empty($this->id)) {
            return self::ESCUTA_ENDPOINT . self::CADASTRAR_ENDPOINT;
        }

        return self::ESCUTA_ENDPOINT . '/' . $this->id . self::CADASTRAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'autenticacao_id' => $this->idAutenticador,
                'numero_processo' => $this->numeroDoProcesso,
                'dias_de_captura' => $this->diasDeCaptura,
                'horarios_de_captura' => $this->horariosDeCaptura,
            ]
        ];
    }
}