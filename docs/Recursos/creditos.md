# Recurso: **Créditos**

Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

### Cotação

Exemplo para realizar a busca da cotação de créditos por ação.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Credito\CreditoCotacaoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $cotacao = new CreditoCotacaoBusca();
    
    $resultado = $intimai->servicos->buscar($cotacao); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### Histórico

Exemplo para realizar a busca do histórico de créditos do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Credito\CreditoHistoricoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
     
    $historico = new CreditoHistoricoBusca();
    
    $resultado = $intimai->servicos->buscar($historico); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### Saldo

Exemplo para realizar a busca do saldo de créditos do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Credito\CreditoSaldoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
     
    $saldo = new CreditoSaldoBusca();
    
    $resultado = $intimai->servicos->buscar($saldo); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### Consumo mensal

Exemplo para buscar o consumo de créditos de um mês, agrupado por tipo de ação. O filtro `date` usa o formato `YYYY-MM`; sem ele, a API usa o mês atual.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Credito\CreditoConsumoMensalBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $resultado = $intimai->servicos->buscar(new CreditoConsumoMensalBusca(), 1, ['date' => '2026-10']);

    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-créditos)        
[Voltar a lista da API](../../README.md#recursos)    
[Voltar para o README](../../README.md#intimaai--sdk-v3-php)