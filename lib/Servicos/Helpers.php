<?php

namespace Intimai\Servicos;

use Intimai\Modelos\Peticao;

trait Helpers
{
    protected function definirPartes(array $partes, array &$parametrosParaMultiForm): void
    {
        foreach ($partes as $chave => $partesVinculada) {
            $parametrosParaMultiForm["partes_vinculadas[$chave][nome]"] = $partesVinculada->getNome();

            if (!empty($partesVinculada->getParticipacao())) {
                $parametrosParaMultiForm["partes_vinculadas[$chave][participacao]"] = $partesVinculada->getParticipacao();
            }
        }
    }

    protected function definirPeticao(?Peticao $peticao, array &$parametrosParaMultiForm): void
    {
        if (isset($peticao)) {
            $parametrosPeticao = $peticao->emArray();

            foreach ($parametrosPeticao as $chavePeticao => $valor) {
                $parametrosParaMultiForm[$chavePeticao] = $valor;
            }
        }
    }

    protected function definirDocumentos(array $documentos, array &$parametrosParaMultiForm): void
    {
        if (!empty($documentos)) {
            foreach ($documentos as $documento) {
                $parametrosDocumento = $documento->emArray();

                foreach ($parametrosDocumento as $chaveDoc => $valor) {
                    $parametrosParaMultiForm[$chaveDoc] = $valor;
                }
            }
        }
    }

    protected function definirMultiPart(array $parametrosParaMultiForm): array
    {
        $multipart = [];

        foreach ($parametrosParaMultiForm as $nome => $conteudo) {
            $multipart[] = [
                'name' => $nome,
                'contents' => $conteudo,
            ];
        }

        return $multipart;
    }
}