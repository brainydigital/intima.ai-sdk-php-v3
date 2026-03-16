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

[Voltar ao topo](#recurso-ações)        
[Voltar a lista da API](../../README.md#documentação-para-os-endpoints-da-api)    
[Voltar para o README](../../README.md#intimaai---sdk-v3-php)
