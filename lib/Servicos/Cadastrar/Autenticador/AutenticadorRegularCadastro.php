<?php

namespace Intimai\Servicos\Cadastrar\Autenticador;

use Intimai\Servicos\Cadastrar\ServicoCadastro;
use Intimai\Servicos\Endpoint;

class AutenticadorRegularCadastro implements ServicoCadastro
{
    use Endpoint;

    private string|int|array $idTribunal;
    private array $oab;
    private string $usuario;
    private string $senha;
    private string|int|null $idCertificado;
    private ?string $usuarioSigla;
    private ?string $usuarioDescricao;
    private ?string $secret;

    public function __construct(
        string|int|array $idTribunal,
        array            $oab,
        string           $usuario,
        string           $senha,
        string|int|null  $idCertificado = null,
        ?string          $usuarioSigla = null,
        ?string          $usuarioDescricao = null,
        ?string          $secret = null
    )
    {
        $this->idTribunal = $idTribunal;
        $this->oab = $oab;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->idCertificado = $idCertificado;
        $this->usuarioSigla = $usuarioSigla;
        $this->usuarioDescricao = $usuarioDescricao;
        $this->secret = $secret;
    }

    public function getEndpoint(): string
    {
        return self::AUTENTICADOR_ENDPOINT . self::REGULAR_ENDPOINT . self::CADASTRAR_ENDPOINT;
    }

    public function getRequest(): array
    {
        return [
            'form_params' => [
                'tribunal_id' => $this->idTribunal,
                'usuario' => $this->usuario,
                'senha' => $this->senha,
                'certificado_id' => $this->idCertificado,
                'oab_numero' => $this->oab['numero'],
                'oab_letra' => $this->oab['letra'] ?? '',
                'oab_uf' => $this->oab['uf'],
                'usuario_sigla' => $this->usuarioSigla,
                'usuario_descricao' => $this->usuarioDescricao,
                'secret' => $this->secret,
            ]
        ];
    }
}
