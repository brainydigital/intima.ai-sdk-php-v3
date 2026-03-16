# Recurso: **Andamentos**

> Com os Andamentos, você poderá visualizar todas as movimentações e documentos
> (PDF e HTML) do polo interno de um processo.

Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

### Geral

Exemplo para realizar uma busca geral de todos os andamentos cadastrados do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Andamento\AndamentoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os registros daquele serviço
    $andamentos = new AndamentoBusca();
    
    $resultado = $intimai->servicos->buscar($andamentos); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### Específica

Exemplo para realizar uma busca específica de um andamento cadastrado do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Andamento\AndamentoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAndamento = 1; // ID do andamento no Intima.ai
     
    $andamento = new AndamentoBusca($idAndamento);
    
    $resultado = $intimai->servicos->buscar($andamento); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Cadastrar**

Exemplo para realizar o cadastro de um andamento.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Cadastrar\Andamento\AndamentoCadastro;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $numeroDoProcesso = '00000000000000000000'; // Número do processo no tribunal
     
    $andamento = new AndamentoCadastro($idAutenticador, $numeroDoProcesso);
    
    $resultado = $intimai->servicos->cadastrar($andamento); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Solicitar**

Exemplo para realizar a captura de um andamento.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Solicitar\Andamento\AndamentoSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAndamento = 1; // ID do andamento no Intima.ai
     
    $andamento = new AndamentoSolicitacao($idAndamento);
    
    $resultado = $intimai->servicos->solicitar($andamento); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Excluir**

Exemplo para realizar a exclusão de um andamento.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Excuir\Andamento\AndamentoExclusao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAndamento = 1; // ID do andamento no Intima.ai
     
    $andamento = new AndamentoExclusao($idAndamento);
    
    $resultado = $intimai->servicos->excluir($andamento); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-andamentos)        
[Voltar a lista da API](../../README.md#documentação-para-os-endpoints-da-api)    
[Voltar para o README](../../README.md#intimaai---sdk-v3-php)
