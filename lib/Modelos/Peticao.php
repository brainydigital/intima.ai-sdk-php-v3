<?php

namespace Intimai\Modelos;

use Exception;

class Peticao
{
    private string $caminho;
    private string $tipo;
    private string $descricao;

    /**
     * Documento constructor.
     * @param string $caminho
     * @param int|string $tipo
     * @param string $descricao
     */
    public function __construct(string $caminho, int|string $tipo = '', string $descricao = '')
    {
        $this->caminho = $caminho;
        $this->tipo = $tipo;
        $this->descricao = $descricao;
    }

    /**
     * @return resource
     * @throws Exception
     */
    public function getArquivo()
    {
        $arquivo = fopen($this->caminho, 'r');

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
            'peticao[arquivo]' => $this->getArquivo(),
            'peticao[tipo_documento]' => $this->tipo,
            'peticao[descricao_documento]' => $this->descricao,
        ];
    }

    public function getTipo(): int|string
    {
        return $this->tipo;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @return string
     */
    public function getCaminho(): string
    {
        return $this->caminho;
    }
}