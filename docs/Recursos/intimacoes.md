# Recurso: **Intimações**

> A captura das intimações ocorrem em determinados horários e dias escolhidos por você, ao se adicionar um tribunal em `Tribunais ativos`.
>
> Para cada "Tribunal ativo" na sua lista de Tribunais ativos, você pode ou não habilitar a
>captura de intimações. Caso a captura de intimações esteja habilitada para o tribunal selecionado,
>será necessario informar os dias da semana em que ocorrerão as capturas, bem como ao menos um
>horário para captura e também quais as abas que deseja que o `INTIMA.AI` realize a captura das
>intimações.
>
> Após finalizada a ação de captura de intimações, será possível verificar todos os documentos
>atrelados as intimações (em texto ou em PDF), bem como realizar a revisão das intimações.


Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## Exemplos

Para solicitar serviços referentes as intimações, você deve instanciar o tipo de serviço antes e inserir nas funções padrões dos serviços. Veja os serviços disponíveis para as intimações nos exemplos abaixo.

### **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

#### Geral

Exemplo para realizar uma busca geral de todas as intimações do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Intimacao\IntimacaoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os registros daquele serviço
    $intimacoes = new IntimacaoBusca();
    
    $resultado = $intimai->servicos->buscar($intimacoes); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar uma busca específica de uma intimação.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Intimacao\IntimacaoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idIntimacao = 1; // ID da intimação no Intima.ai
    
    $intimacao = new IntimacaoBusca($idIntimacao);
    
    $resultado = $intimai->servicos->buscar($intimacao); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### **Atualização**

#### **Marcar como revisada**

> Você pode marcar a intimação como revisada para melhor organização.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Modelos\Certificado;
use Intimai\Servicos\Atualizar\Intimacao\IntimacaoMarcarComoRevisadaAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idIntimacao = 1; // ID da intimação no Intima.ai
    
    $intimacao = new IntimacaoMarcarComoRevisadaAtualizacao($idIntimacao);
    
    $resultado = $intimai->servicos->atualizar($intimacao); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-intimações)        
[Voltar a lista da API](../../README.md#recursos)    
[Voltar para o README](../../README.md#intimaai--sdk-v3-php)
