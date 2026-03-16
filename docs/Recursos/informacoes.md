# Recurso: **Informações**

> Com as informações, você poderá obter todas as informações do processo, tais como:
> valor da causa, classe judicial, assuntos, polos e etc.


Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## Exemplos

Para solicitar serviços referentes as informações, você deve instanciar o tipo de serviço antes e inserir nas funções padrões dos serviços. Veja os serviços disponíveis para as informações nos exemplos abaixo.

## **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

### Geral

Exemplo para realizar uma busca geral de todas as informações processuais do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Informacao\InformacaoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os registros daquele serviço
    $informacoes = new InformacaoBusca();
    
    $resultado = $intimai->servicos->buscar($informacoes); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar uma busca específica de uma informação processual.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Informacao\InformacaoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idInformacao = 1; // ID da informação no Intima.ai
     
    $informacao = new InformacaoBusca($idInformacao);
    
    $resultado = $intimai->servicos->buscar($informacao); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Solicitação**

Exemplo para realizar a solicitação de uma informação processual.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Solicitar\Informacao\InformacaoSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $numeroDoProcesso = '00000000000000000000'; // Número do processo no tribunal
     
    $informacao = new InformacaoSolicitacao($idAutenticador, $numeroDoProcesso);
    
    $resultado = $intimai->servicos->solicitar($informacao); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-informações)        
[Voltar a lista da API](../../README.md#documentação-para-os-endpoints-da-api)    
[Voltar para o README](../../README.md#intimaai---sdk-v3-php)
