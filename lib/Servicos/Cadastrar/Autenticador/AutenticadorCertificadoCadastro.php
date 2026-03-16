<?php

namespace Intimai\Servicos\Cadastrar\Autenticador;

use Intimai\Servicos\Cadastrar\ServicoCadastro;
use Intimai\Servicos\Endpoint;

class AutenticadorCertificadoCadastro implements ServicoCadastro
{
    use Endpoint;

    private string|int $idTribunal;
    private array $oab;
    private string|int $idCertificado;

    public function __construct(string|int $idTribunal, array $oab, string|int $idCertificado)
    {
        $this->idTribunal = $idTribunal;
        $this->oab = $oab;
        $this->idCertificado = $idCertificado;
    }

    public function getEndpoint(): string
    {
       return self::AUTENTICADOR_ENDPOINT . self::CERTIFICADO_ENDPOINT . self::CADASTRAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'tribunal_id' => $this->idTribunal,
                'certificado_id' => $this->idCertificado,
                'oab_numero' => $this->oab['numero'],
                'oab_letra' => $this->oab['letra'] ?? '',
                'oab_uf' => $this->oab['uf'],
            ]
        ];
    }
}