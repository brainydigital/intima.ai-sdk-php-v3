# Recurso: **Escutas**

> Com a escuta você pode saber todas as movimentações que ocorreram em um processo,
> e baixar todos os novos documentos anexados ao processo. Para realiza-lá
> é bastante simples, bastando somente informar o numero do processo, tribunal e os dias/horários que
> deseja realizar.

Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

### Geral

Exemplo para realizar uma busca geral de todas as escutas cadastradas do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Escuta\EscutaBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os registros daquele serviço
    $escutas = new EscutaBusca();
    
    $resultado = $intimai->servicos->buscar($escutas); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar uma busca específica de uma escuta.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Escuta\EscutaBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idEscuta = 1; // ID da escuta no Intima.ai
     
    $escuta = new EscutaBusca($idEscuta);
    
    $resultado = $intimai->servicos->buscar($escuta); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Cadastrar**

Exemplo para realizar o cadastro de uma escuta.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Utilidades\Dia;
use Intimai\Utilidades\Horario;
use Intimai\Servicos\Cadastrar\Escuta\EscutaCadastro;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // ID do autenticador no Intima.ai
    $idAutenticador = 1;
    
    // Número do processo no tribunal
    $numeroDoProcesso = '00000000000000000000';
    
    // Dias no qual a captura será realizada
    $diasDeCaptura = [
        Dia::SEGUNDA_FEIRA,
        Dia::SEXTA_FEIRA
    ];
    
    // Horários no qual a captura será realizada
    $horariosDeCaptura = [
        Horario::DEZ_HORAS,
        Horario::DEZOITO_HORAS
    ];
     
    $escuta = new EscutaCadastro(
        $idAutenticador,
        $numeroDoProcesso,
        $diasDeCaptura,
        $horariosDeCaptura
    );
    
    $resultado = $intimai->servicos->cadastrar($escuta); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Atualizar**

Exemplo para realizar a atualização de uma escuta.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Utilidades\Dia;
use Intimai\Servicos\Atualizar\Escuta\EscutaAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idEscuta = 1; // ID da escuta no Intima.ai
    
    // Dias no qual a captura será realizada
    $diasDeCaptura = [
        Dia::SEGUNDA_FEIRA,
        Dia::SEXTA_FEIRA
    ];
    
    // Horários no qual a captura será realizada
    $horariosDeCaptura = [
        Horario::DEZ_HORAS,
        Horario::DEZOITO_HORAS
    ];
     
    $escuta = new EscutaAtualizacao($idEscuta, $diasDeCaptura, $horariosDeCaptura);
    
    $resultado = $intimai->servicos->atualizar($escuta); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Excluir**

Exemplo para realizar a exclusão de uma escuta.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Excuir\Escuta\EscutaExclusao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idEscuta = 1; // ID da escuta no Intima.ai
     
    $escuta = new EscutaExclusao($idEscuta);
    
    $resultado = $intimai->servicos->excluir($escuta); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-escutas)        
[Voltar a lista da API](../../README.md#documentação-para-os-endpoints-da-api)    
[Voltar para o README](../../README.md#intimaai---sdk-v3-php)