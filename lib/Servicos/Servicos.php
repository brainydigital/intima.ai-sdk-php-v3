<?php

namespace Intimai\Servicos;

use GuzzleHttp\Exception\GuzzleException;
use Intimai\API\API;
use Intimai\Exceptions\APIRequestException;
use Intimai\Servicos\Atualizar\ServicoAtualizacao;
use Intimai\Servicos\Buscar\ServicoBusca;
use Intimai\Servicos\Cadastrar\ServicoCadastro;
use Intimai\Servicos\Excuir\ServicoExclusao;
use Intimai\Servicos\Resultado\ServicoResultado;
use Intimai\Servicos\Solicitar\ServicoSolicitacao;
use Intimai\Servicos\SolicitarAtualizacao\ServicoSolicitaAtualizacao;
use Intimai\Servicos\SolicitarCadastro\ServicoSolicitacaoCadastro;
use Intimai\Servicos\SolicitarExclusao\ServicoSolicitacaoExclusao;
use Intimai\Servicos\TentarNovamente\ServicoTentaNovamente;

class Servicos
{
    private API $api;

    public function __construct(API $api)
    {
        $this->api = $api;
    }

    /**
     * Envia a solicitação do servico (ação) para a API.
     * @param ServicoSolicitacao $servico
     * @return array
     * @throws APIRequestException
     * @throws GuzzleException
     */
    public function solicitar(ServicoSolicitacao $servico): array
    {
        $endpoint = $servico->getEndpoint();
        $request = $servico->getRequest();

        return $this->api->post($endpoint, $request);
    }

    /**
     * Busca todos os serviços (ações) de acordo com o tipo do servico ou o serviço específico caso o serviço de busca possua id.
     * @param ServicoBusca $servico
     * @param int $pagina
     * @param array $filtros
     * @return array
     * @throws APIRequestException
     * @throws GuzzleException
     */
    public function buscar(ServicoBusca $servico, int $pagina = 1, array $filtros = []): array
    {
        $endpoint = $servico->getEndpoint();

        return $this->api->get($endpoint, $pagina, $filtros);
    }

    /**
     * Cadastra um novo serviço. Obs: metodo disponível apenas para Escuta ou Andamento.
     * @param ServicoCadastro $servico
     * @return array
     * @throws APIRequestException
     * @throws GuzzleException
     */
    public function cadastrar(ServicoCadastro $servico): array
    {
        $endpoint = $servico->getEndpoint();
        $request = $servico->getRequest();

        return $this->api->post($endpoint, $request);
    }

    public function atualizar(ServicoAtualizacao $servico): array
    {
        $endpoint = $servico->getEndpoint();
        $request = $servico->getRequest();

        return $this->api->put($endpoint, $request);
    }

    public function excluir(ServicoExclusao $servico): array
    {
        $endpoint = $servico->getEndpoint();

        return $this->api->delete($endpoint);
    }

    public function solicitarCadastro(ServicoSolicitacaoCadastro $servico): array
    {
        $endpoint = $servico->getEndpoint();
        $request = $servico->getRequest();

        return $this->api->post($endpoint, $request);
    }

    public function solicitarAtualizacao(ServicoSolicitaAtualizacao $servico): array
    {
        $endpoint = $servico->getEndpoint();
        $request = $servico->getRequest();

        return $this->api->post($endpoint, $request);
    }

    public function solicitarExclusao(ServicoSolicitacaoExclusao $servico): array
    {
        $endpoint = $servico->getEndpoint();

        return $this->api->delete($endpoint);
    }

    public function resultado(ServicoResultado $servico): array
    {
        $endpoint = $servico->getEndpoint();

        return $this->api->get($endpoint);
    }

    public function tentarNovamente(ServicoTentaNovamente $servico): array
    {
        $endpoint = $servico->getEndpoint();

        return $this->api->get($endpoint);
    }
}
