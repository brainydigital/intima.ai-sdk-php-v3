<?php

namespace Intimai\Servicos;

trait Endpoint
{
    // SERVIÇOS
    protected const BUSCAR_ENDPOINT = '/buscar';
    protected const CADASTRAR_ENDPOINT = '/cadastrar';
    protected const EXCLUIR_ENDPOINT = '/excluir';
    protected const ATUALIZAR_ENDPOINT = '/atualizar';
    protected const SOLICITAR_ENDPOINT = '/solicitar';
    protected const PRIMEIRA_ETAPA_ENDPOINT = '/primeira-etapa';
    protected const SEGUNDA_ETAPA_ENDPOINT = '/segunda-etapa';
    protected const MARCAR_COMO_REVISADA_ENDPOINT = '/marcar-como-revisada';
    protected const SOLICITAR_ATUALIZACAO_ENDPOINT = '/solicitar-atualizacao';
    protected const SOLICITAR_CADASTRO_ENDPOINT = '/solicitar-cadastro';
    protected const SOLICITAR_EXCLUSAO_ENDPOINT = '/solicitar-exclusao';

    // PROCESSOS
    protected const ANDAMENTO_ENDPOINT = '/andamento-processual';
    protected const CONSULTA_ENDPOINT = '/consulta-processual';
    protected const CONSULTA_PRE_ANALISE_ENDPOINT = '/pre-consulta-processual';
    protected const COPIA_ENDPOINT = '/copia-processual';
    protected const ESCUTA_ENDPOINT = '/escuta-processual';
    protected const INFORMACAO_ENDPOINT = '/informacao-processual';
    protected const INTIMACAO_ENDPOINT = '/intimacao';
    protected const PROTOCOLO_ENDPOINT = '/protocolo-processual';
    protected const PROTOCOLO_HABILITACAO_ENDPOINT = '/protocolo-habilitacao';

    // SISTEMAS
    protected const ESAJ_ENDPOINT = '/esaj';
    protected const EPROC_ENDPOINT = '/eproc';
    protected const TJRJ_ENDPOINT = '/tjrj';
    protected const PJE_ENDPOINT = '/pje';
    protected const PROJUDI_ENDPOINT = '/projudi';

    // AUTENTICADOR
    protected const AUTENTICADOR_ENDPOINT = '/autenticador';
    protected const REGULAR_ENDPOINT = '/regular';
    protected const CERTIFICADO_ENDPOINT = '/certificado';

    // NOTIFICAÇÃO
    protected const NOTIFICACAO_ENDPOINT = '/notificacao';
    protected const EMAIL_ENDPOINT = '/email';
    protected const WEBHOOK_ENDPOINT = '/webhook';

    // UTILS
    protected const CREDITO_ENDPOINT = '/credito';
    protected const COTACAO_ACOES_ENDPOINT = '/cotacao-acoes';
    protected const HISTORICO_ENDPOINT = '/historico';
    protected const SALDO_ENDPOINT = '/saldo';
    protected const TRANSACAO_ENDPOINT = '/transacao';
    protected const TRIBUNAL_ENDPOINT = '/tribunal';
    protected const USUARIO_ENDPOINT = '/usuario';
    protected const ACAO_ENDPOINT = '/acao';
    protected const TENTAR_NOVAMENTE_ENDPOINT = '/tentar-novamente';
    protected const RESULTADO_ENDPOINT = '/resultado';
    protected const ALTERAR_PARA_REGULAR_ENDPOINT = '/alterar-para-regular';
    protected const ALTERAR_PARA_CERTIFICADO_ENDPOINT = '/alterar-para-certificado';
    protected const TIPOS_DOCUMENTO_ENDPOINT = '/tipos-documento';
    protected const CLASSES_ENDPOINT = '/classes';
    protected const EVENTOS_ENDPOINT = '/eventos';
    protected const TIPOS_DOCUMENTO_MENSAGEM_GERAL_ENDPOINT = '/tipos-documento-mensagem-geral';
}
