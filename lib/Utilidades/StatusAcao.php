<?php

namespace Intimai\Utilidades;

class StatusAcao
{
    public const PENDENTE = 0;
    public const FINALIZADO = 1;
    public const PROCESSANDO = 2;
    public const ERRO = 3;
    public const NA_FILA = 4;
    public const PREPARANDO_DOCUMENTOS = 5;
    public const ESPERANDO_ACAO_USUARIO = 6;
    public const TENTANDO_NOVAMENTE = 7;
    public const ESPERANDO = 8;
    public const ESPERANDO_ARQUIVOS = 9;
    public const ESPERANDO_2FA = 10;
    public const USUARIO_SELECIONADO_NAO_ENCONTRADO = 11;
    public const AGUARDANDO_DADOS_FISCAIS = 12;
    public const AGUARDANDO_CONFIRMACAO = 13;
    public const CANCELADA = 14;
}
