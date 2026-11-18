# Recurso: **Tribunais**

> Os tribunais correspondem a todos os sistemas jurídicos disponíveis no `Intima.ai`
> (PJE, ESAJ, PROJUDI, EPROC e etc).
>
> Para cada tribunal, você pode definir se deseja realizar as captura de intimações
> (definir dias e horários do seu agrado) e associar uma `Autenticação`.
>
> A `Autenticação` pode ser um certificado A1 ou usuário/senha, mas sempre deve-se
> ficar atento as funcionalidades suportadas por cada tribunal.


Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## Exemplos

Para solicitar serviços referentes aos tribunais, você deve instanciar o tipo de serviço antes e inserir nas funções padrões dos serviços. Veja os serviços disponíveis para o tribunal nos exemplos abaixo.

### **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

#### Geral

Exemplo para realizar a busca geral de todas os tribunais disponíveis no `Intima.ai`.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Tribunal\TribunalBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os registros daquele serviço
    $tribunais = new TribunalBusca();
    
    $resultado = $intimai->servicos->buscar($tribunais); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar a busca específica de um tribunal.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Tribunal\TribunalBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idTribunal = 1; // ID do tribunal no Intima.ai
    $tribunal = new TribunalBusca($idTribunal);
    
    $resultado = $intimai->servicos->buscar($tribunal); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-tribunais)        
[Voltar a lista da API](../../README.md#recursos)    
[Voltar para o README](../../README.md#intimaai--sdk-v3-php)
