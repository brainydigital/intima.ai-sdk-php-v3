# Recurso: **Códigos de Ajuda**

> Catálogo dos códigos de erro que uma ação pode retornar: o que cada um significa, se gera cobrança
> e se tem **nova tentativa automática**. É o mesmo conteúdo da página Códigos de Ajuda do painel.

Todas as URIs são relativas a *https://app.intima.ai/api/v3*

| Método | Rota                    |
| ------ | ----------------------- |
| GET    | `/codigo-ajuda/buscar`  |

## **Busca**

| Filtro   | Valores                                                                                   |
| -------- | ----------------------------------------------------------------------------------------- |
| `codigo` | Opcional. Filtra pelo código (ex.: `606`). Sem ele vem o catálogo inteiro. Código fora do catálogo retorna `404`. |

Resposta (`data`):

| Campo                  | Descrição                                                                                                      |
| ---------------------- | -------------------------------------------------------------------------------------------------------------- |
| `faixas`               | Faixas de cobrança (`total`, `parcial`, `isenta`) com a explicação e quantos códigos há em cada uma             |
| `nova_tentativa_aviso` | Regra geral: só os códigos com `nova_tentativa` preenchido são repetidos pela plataforma, em ações do mesmo dia |
| `grupos[].codigos[]`   | `codigo`, `mensagem`, `descricao`, `observacao`, `faixa`, `cobranca` e `nova_tentativa`                         |

`nova_tentativa` de cada código é o texto da regra (quantas vezes e de quanto em quanto tempo) ou `null` quando o código não tem nova tentativa automática.

### Catálogo inteiro

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\CodigoAjuda\CodigoAjudaBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $resultado = $intimai->servicos->buscar(new CodigoAjudaBusca());

    var_dump($resultado['data']['grupos']);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
}

?>
```

### Um código

Antes de criar outra ação para um erro, confira se a plataforma já vai repetir a ação sozinha.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\CodigoAjuda\CodigoAjudaBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $resultado = $intimai->servicos->buscar(new CodigoAjudaBusca(), 1, ['codigo' => 606]);

    $codigo = $resultado['data']['grupos'][0]['codigos'][0];

    var_dump($codigo['mensagem'], $codigo['faixa'], $codigo['nova_tentativa']);
} catch (APIRequestException $exception) {
    if ($exception->getStatus() === 404) {
        // código fora do catálogo
    }

    var_dump($exception->getMensagem());
}

?>
```

[Voltar ao topo](#recurso-códigos-de-ajuda)        
[Voltar a lista da API](../../README.md#recursos)    
[Voltar para o README](../../README.md#intimaai--sdk-v3-php)
