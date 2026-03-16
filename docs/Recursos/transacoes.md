# Recurso: **Transações

### Histórico

Exemplo para realizar a busca do histórico de transações do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Transacao\TransacaoHistoricoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
     
    $historico = new TransacaoHistoricoBusca();
    
    $resultado = $intimai->servicos->buscar($historico); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-transações)        
[Voltar a lista da API](../../README.md#documentação-para-os-endpoints-da-api)    
[Voltar para o README](../../README.md#intimaai---sdk-v3-php)