# Recurso: **Ações**

> Todas as ações realizadas dentro do `Intima.ai`, ficam registradas neste recurso. Você pode
> buscar (todas ou uma ação específica), buscar o resultado ou tentar novamente.

Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

### Geral

Exemplo para realizar uma busca geral de todas as ações do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Acao\AcaoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os registros daquele serviço
    $acoes = new AcaoBusca();
    
    $resultado = $intimai->servicos->buscar($acoes); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar uma busca específica de uma ação do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Acao\AcaoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAcao = 1; // ID da ação no Intima.ai
     
    $acao = new AcaoBusca($idAcao);
    
    $resultado = $intimai->servicos->buscar($acao); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Resultado**

Exemplo para realizar a busca do resultado de uma ação.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Resultado\Acao\AcaoResultado;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAcao = 1; // ID da ação no Intima.ai
     
    $acao = new AcaoResultado($idAcao);
    
    $resultado = $intimai->servicos->resultado($acao); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Tentar Novamente**

Exemplo para tentar novamente uma ação que tenha falhado.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\TentarNovamente\Acao\AcaoTentaNovamente;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAcao = 1; // ID da ação no Intima.ai
     
    $acao = new AcaoTentaNovamente($idAcao);
    
    $resultado = $intimai->servicos->tentarNovamente($acao); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Nova tentativa automática**

A ação com erro (`StatusAcao::ERRO`) traz o bloco `nova_tentativa`; nos outros status ele vem `null`. Use-o antes de criar outra ação: se `automatica` for `true`, a plataforma repete a ação sozinha e não é preciso criar outra. As regras de cada código estão no recurso [Códigos de Ajuda](codigosAjuda.md#recurso-códigos-de-ajuda).

| Campo            | Descrição                                                                                     |
| ---------------- | --------------------------------------------------------------------------------------------- |
| `automatica`     | `true` quando a plataforma ainda vai repetir a ação                                            |
| `situacao`       | `SituacaoNovaTentativa::AGENDADA`, `AGUARDANDO_CONDICAO`, `ENCERRADA` ou `SEM_NOVA_TENTATIVA` |
| `tentativa`      | Número da próxima tentativa (quando agendada)                                                  |
| `max_tentativas` | Total de tentativas da regra                                                                   |
| `prevista_para`  | Data e hora previstas da próxima tentativa                                                     |
| `mensagem`       | Texto pronto para mostrar ao usuário                                                           |

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Acao\AcaoBusca;
use Intimai\Utilidades\SituacaoNovaTentativa;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $novaTentativa = $intimai->servicos->buscar(new AcaoBusca(1))['data']['nova_tentativa'];

    if ($novaTentativa === null) {
        // A ação não está com erro
    } elseif ($novaTentativa['automatica']) {
        // A plataforma vai repetir sozinha: não crie outra ação
        echo $novaTentativa['mensagem'];
    } elseif ($novaTentativa['situacao'] === SituacaoNovaTentativa::SEM_NOVA_TENTATIVA) {
        // Corrija a causa do erro antes de criar outra ação
    }
} catch (APIRequestException $exception) {
    var_dump($exception->getStatus(), $exception->getMensagem());
}

?>
```

## **Confirmar ou cancelar consulta**

Toda consulta processual por perfil passa por uma pré-análise. Quando ela encontra processos, a consulta para em `StatusAcao::AGUARDANDO_CONFIRMACAO` (13) e a resposta da ação traz o bloco `confirmacao` (total de processos, custo estimado e `expira_em`). A confirmação vale por 1 hora. Cancelar leva a consulta a `StatusAcao::CANCELADA` (14).

| Método | Rota                                  |
| ------ | ------------------------------------- |
| POST   | `/acao/{acao_id}/confirmar-consulta`  |
| POST   | `/acao/{acao_id}/cancelar-consulta`   |

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Acao\AcaoBusca;
use Intimai\Servicos\Solicitar\Acao\AcaoConfirmarConsultaSolicitacao;
use Intimai\Servicos\Solicitar\Acao\AcaoCancelarConsultaSolicitacao;
use Intimai\Utilidades\StatusAcao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $idAcao = 1; // ID da consulta (ação) no Intima.ai

    $consulta = $intimai->servicos->buscar(new AcaoBusca($idAcao));

    if ($consulta['data']['status'] === StatusAcao::AGUARDANDO_CONFIRMACAO) {
        $confirmacao = $consulta['data']['confirmacao']; // total, custo_estimado, expira_em...

        $resultado = $intimai->servicos->solicitar(new AcaoConfirmarConsultaSolicitacao($idAcao));
        // ou: $intimai->servicos->solicitar(new AcaoCancelarConsultaSolicitacao($idAcao));
    }
} catch (APIRequestException $exception) {
    var_dump($exception->getStatus(), $exception->getMensagem());
}

?>
```

[Voltar ao topo](#recurso-ações)        
[Voltar a lista da API](../../README.md#recursos)    
[Voltar para o README](../../README.md#intimaai--sdk-v3-php)
