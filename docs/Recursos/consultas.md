# Recurso: **Consultas**

> Com este recurso você poderá realizar consultas de todos os processos disponíveis em qualquer
> tribunal do Brasil. Bastando apenas informar o `numero do proceso` ou o `nome da parte` ou o `nome do 
> representante`.
>
> O `Intima.ai` recomenda que antes de realizar qualquer consulta processual, primeiro solicite
> a `pré-analise da consulta`, pois dependendo dos termos utilizados na consulta,
> poderá haver um numero muito alto de registros encontrados, consumindo assim seus créditos.
>
> A `pré-analise de uma consulta` retorna a quantidade de registros encontrados com os
> termos de busca informados.
>
> Ao solicitar uma consulta por perfil, a API faz a pré-análise sozinha. Se houver processos, a
> consulta para em `StatusAcao::AGUARDANDO_CONFIRMACAO` (13) e só segue depois de confirmada
> (veja [Confirmar ou cancelar consulta](acoes.md#confirmar-ou-cancelar-consulta)). Sem
> confirmação em 1 hora, a consulta expira.
>
> No EPROC, informe só um parâmetro de busca: número do processo **ou** documento da parte
> **ou** OAB. Nome da parte e nome do representante ainda não são aceitos nesse sistema.

Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

### Geral

Exemplo para realizar uma busca geral de todas as consultas do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Consulta\ConsultaBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os registros daquele serviço
    $consultas = new ConsultaBusca();
    
    $resultado = $intimai->servicos->buscar($consultas); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar uma busca específica de uma consulta do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Consulta\ConsultaBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idConsulta = 1; // ID da consulta no Intima.ai
     
    $consulta = new ConsultaBusca($idConsulta);
    
    $resultado = $intimai->servicos->buscar($consulta); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Solicitar**

Exemplo para realizar a solicitação de uma consulta.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Solicitar\Consulta\ConsultaSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $numeroDoProcesso = '00000000000000000000'; // Número do processo no tribunal
    // OU nome do representante >> $nomeRepresentante = 'nome-representante';
     
    $consulta = new ConsultaSolicitacao($idAutenticador, $numeroDoProcesso);
    
    $resultado = $intimai->servicos->solicitar($consulta); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Resultado**

Exemplo para realizar a busca do resultado de uma consulta.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Resultado\Consulta\ConsultaResultado;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idConsulta = 1; // ID da consulta no Intima.ai
     
    $consulta = new ConsultaResultado($idConsulta);
    
    $resultado = $intimai->servicos->resultado($consulta); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-consultas)        
[Voltar a lista da API](../../README.md#recursos)    
[Voltar para o README](../../README.md#intimaai--sdk-v3-php)
