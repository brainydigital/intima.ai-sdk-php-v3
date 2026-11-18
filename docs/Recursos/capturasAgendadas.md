# Recurso: **Capturas Agendadas**

> Cada horário agendado de captura de intimações ou de escuta processual vira uma linha neste recurso.
> Assim você acompanha o que rodou, o que deu erro e o que não chegou a ser executado (com o motivo).

Todas as URIs são relativas a *https://app.intima.ai/api/v3*

| Método | Rota                                              |
| ------ | ------------------------------------------------- |
| GET    | `/captura-agendada/buscar`                        |
| GET    | `/captura-agendada/{captura_agendada_id}/buscar`  |

## **Busca**

### Geral

Filtros aceitos (todos opcionais; os de lista aceitam `1,2,3`):

| Filtro               | Valores                                                                 |
| -------------------- | ----------------------------------------------------------------------- |
| `data_inicial`       | data inicial do horário previsto                                        |
| `data_final`         | data final do horário previsto                                          |
| `autenticadores_ids` | IDs de autenticadores                                                   |
| `escutas_ids`        | IDs de escutas processuais                                              |
| `tipos`              | `TipoCapturaAgendada::INTIMACAO`, `TipoCapturaAgendada::ESCUTA`         |
| `situacoes`          | `SituacaoCapturaAgendada::EM_ANDAMENTO`, `FINALIZADA`, `NAO_EXECUTADA`, `ERRO` |
| `motivos`            | motivo de não execução                                                  |

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\CapturaAgendada\CapturaAgendadaBusca;
use Intimai\Utilidades\SituacaoCapturaAgendada;
use Intimai\Utilidades\TipoCapturaAgendada;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $filtros = [
        'tipos' => TipoCapturaAgendada::INTIMACAO,
        'situacoes' => SituacaoCapturaAgendada::NAO_EXECUTADA . ',' . SituacaoCapturaAgendada::ERRO,
        'autenticadores_ids' => '1,2',
    ];

    $resultado = $intimai->servicos->buscar(new CapturaAgendadaBusca(), 1, $filtros);

    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
}

?>
```

### Específica

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\CapturaAgendada\CapturaAgendadaBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $idCapturaAgendada = 1; // ID da captura agendada no Intima.ai

    $resultado = $intimai->servicos->buscar(new CapturaAgendadaBusca($idCapturaAgendada));

    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
}

?>
```

[Voltar ao topo](#recurso-capturas-agendadas)        
[Voltar para o README](../../README.md#intimaai--sdk-v3-php)
