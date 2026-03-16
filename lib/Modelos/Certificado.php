<?php

namespace Intimai\Modelos;

use Exception;

class Certificado
{
    private string $caminhoDoCertificado;
    private string $senha;

    /**
     * Documento constructor.
     * @param string $caminhoDoCertificado
     * @param string $senha
     */
    public function __construct(string $caminhoDoCertificado, string $senha)
    {
        $this->caminhoDoCertificado = $caminhoDoCertificado;
        $this->senha = $senha;
    }

    /**
     * @return string
     */
    public function getCaminhoDoCertificado(): string
    {
        return $this->caminhoDoCertificado;
    }

    /**
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * @return resource
     * @throws Exception
     */
    public function getArquivo()
    {
        $arquivo = fopen($this->caminhoDoCertificado, 'r');

        if ($arquivo === false) {
            throw new Exception('O caminho do arquivo informado é inválido!');
        }

        return $arquivo;
    }

    /**
     * @throws Exception
     */
    public function emArray(): array
    {
        return [
            [
                'name' => 'arquivo',
                'contents' => $this->getArquivo(),
                'filename' => basename($this->caminhoDoCertificado),
            ],
            [
                'name' => 'senha',
                'contents' => $this->senha
            ],
            [
                'name' => 'senha_confirmation',
                'contents' => $this->senha
            ]
        ];
    }
}