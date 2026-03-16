<?php

namespace Intimai\Modelos;

use Exception;

class Documento
{
    private string $caminho;
    private string $tipo;
    private string $descricao;
    private int $ordem;

    /**
     * Documento constructor.
     * @param string $caminho
     * @param int $ordem
     * @param int|string $tipo
     * @param string $descricao
     */
    public function __construct(string $caminho, int $ordem, int|string $tipo = '', string $descricao = '')
    {
        $this->caminho = $caminho;
        $this->tipo = $tipo;
        $this->descricao = $descricao;
        $this->ordem = $ordem;
    }

    /**
     * @return string
     */
    public function getCaminho(): string
    {
        return $this->caminho;
    }

    /**
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @return int
     */
    public function getOrdem(): int
    {
        return $this->ordem;
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

    public function emArray(): array
    {
        $index = $this->ordem - 1;

        return [
            "documentos[$index][arquivo]" => $this->getArquivo(),
            "documentos[$index][tipo_documento]" => $this->tipo,
            "documentos[$index][descricao_documento]" => $this->descricao,
            "documentos[$index][ordem]" => $this->ordem,
        ];
    }
}