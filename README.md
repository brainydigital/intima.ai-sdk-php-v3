<br />
<div align="center">
  <a href="#">
    <img src="https://raw.githubusercontent.com/brainydigital/intima.ai-sdk-php/master/docs/images/logo.png" alt="Logo" width="120" height="120">
  </a>

[![Packagist - Downloads](https://img.shields.io/packagist/dt/brainydigital/intima.ai-sdk-php.svg?style=flat&color=97ca00)](https://packagist.org/packages/brainydigital/intima.ai-sdk-php "View this project on packagist")
[![Packagist - Version](https://img.shields.io/packagist/v/brainydigital/intima.ai-sdk-php.svg?style=flat&color=blue)](https://packagist.org/packages/brainydigital/intima.ai-sdk-php "View this project on packagist")
[![Contributors](https://img.shields.io/badge/contributors-2-yellow.svg)](https://github.com/brainydigital/intima.ai-sdk-php/graphs/contributors)
[![MIT license](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://opensource.org/licenses/MIT)
</div>

# Intima.ai — SDK V3 PHP

Implementação da API V3 do [Intima.ai](https://app.intima.ai) em forma de SDK Client para PHP. Cobre todas as ações disponíveis na plataforma e as expõe como métodos prontos para integração, bastando um `api_token` válido.

- **Versão da API:** 3.0.0
- **Referência completa:** [Postman Docs](https://documenter.getpostman.com/view/11707205/2sAYBaAVnT)

## Requisitos

- PHP >= 8.2

## Instalação

### Via Composer

```bash
composer require brainydigital/intima.ai-sdk-v3-php
```

### Manual

Baixe os arquivos e inclua o autoload:

```php
require_once('/caminho/para/vendor/autoload.php');
```

## Início Rápido

Antes de executar qualquer ação, você precisa:

1. **Importar um Certificado A1** na sua conta (emitido por qualquer certificadora autorizada), _ou_ cadastrar um autenticador com usuário/senha, caso o tribunal suporte;
2. **Criar uma Autenticação** para cada tribunal onde deseja operar;
3. **Solicitar ações** usando os serviços correspondentes.

### Exemplo: Solicitar cópia processual

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Solicitar\Copia\CopiaSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('seu_api_token');

    $idAutenticador = 1;                          // ID do autenticador no Intima.ai
    $numeroDoProcesso = '00000000000000000000';   // Número do processo no tribunal

    $copia = new CopiaSolicitacao($idAutenticador, $numeroDoProcesso);

    $resultado = $intimai->servicos->solicitar($copia);

    dump($resultado);
} catch (APIRequestException $exception) {
    dump($exception->toJson());
} catch (\Exception $exception) {
    dump($exception->getMessage());
}
```

## Paginação e Filtros

Os serviços de busca suportam paginação e filtros opcionais:

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Copia\CopiaBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('seu_api_token');

    $copias  = new CopiaBusca();
    $pagina  = 5;
    $filtros = ['filtro_1' => 'valor'];

    $resultado = $intimai->servicos->buscar($copias, $pagina, $filtros);

    dump($resultado);
} catch (APIRequestException $exception) {
    dump($exception->toJson());
} catch (\Exception $exception) {
    dump($exception->getMessage());
}
```

## Serviços Disponíveis

| Serviço               | Recursos disponíveis                                                                                                                                                                                  |
| --------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Atualizar             | Autenticador, Escuta, Intimação, Notificação                                                                                                                                                          |
| Buscar                | Ação, Andamento, Autenticador, Certificado, Consulta, Consulta pré-análise, Cópia, Crédito, Escuta, Informação, Intimação, Notificação, Protocolo, Protocolo Habilitação, Transação, Tribunal, Usuário |
| Cadastrar             | Andamento, Autenticador, Escuta, Notificação                                                                                                                                                          |
| Excluir               | Andamento, Escuta, Notificação                                                                                                                                                                        |
| Resultado             | Ação, Andamento, Consulta, Escuta                                                                                                                                                                     |
| Solicitar             | Andamento, Consulta, Consulta pré-análise, Cópia, Escuta, Informação, Protocolo, Protocolo Habilitação                                                                                                |
| Solicitar Atualização | Certificado                                                                                                                                                                                           |
| Solicitar Cadastro    | Certificado                                                                                                                                                                                           |
| Solicitar Exclusão    | Certificado                                                                                                                                                                                           |
| Tentar Novamente      | Ação                                                                                                                                                                                                  |

## Recursos

| Recurso                                                                                                     | Descrição                                                                       |
| ----------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------- |
| [**Ações**](docs/Recursos/acoes.md#recurso-ações)                                                           | Endpoints para ações realizadas no Intima.ai                                    |
| [**Andamentos**](docs/Recursos/andamentos.md#recurso-andamentos)                                            | Endpoints para andamentos processuais                                           |
| [**Autenticações**](docs/Recursos/autenticacoes.md#recurso-autenticacões)                                   | Endpoints para autenticações                                                    |
| [**Certificados**](docs/Recursos/certificados.md#recurso-certificados)                                      | Endpoints para certificados                                                     |
| [**Consultas**](docs/Recursos/consultas.md#recurso-consultas)                                               | Endpoints para consultas processuais e pré-análises                             |
| [**Cópias**](docs/Recursos/copias.md#recurso-cópias)                                                        | Endpoints para cópias processuais                                               |
| [**Créditos**](docs/Recursos/creditos.md#recurso-créditos)                                                  | Endpoints para créditos no Intima.ai                                            |
| [**Escutas**](docs/Recursos/escutas.md#recurso-escutas)                                                     | Endpoints para escutas processuais                                              |
| [**Informações**](docs/Recursos/informacoes.md#recurso-informações)                                         | Endpoints para informações processuais                                          |
| [**Intimações**](docs/Recursos/intimacoes.md#recurso-intimações)                                            | Endpoints para intimações capturadas                                            |
| [**Notificações**](docs/Recursos/notificacoes.md#recurso-notificações)                                      | Endpoints para notificações do usuário                                          |
| [**Protocolos**](docs/Recursos/protocolos.md#recurso-protocolos)                                            | Endpoints para protocolos                                                       |
| [**Protocolos de Habilitação**](docs/Recursos/protocolosDeHabilitacao.md#recurso-protocolos-de-habilitação) | Endpoints para protocolos de habilitação                                        |
| [**Transações**](docs/Recursos/transacoes.md#recurs-transações)                                             | Endpoints para transações no Intima.ai                                          |
| [**Tribunais**](docs/Recursos/tribunais.md#recurso-tribunais)                                               | Endpoints para tribunais                                                        |
| [**Usuários**](docs/Recursos/usuarios.md#recurso-usuários)                                                  | Endpoints para o usuário                                                        |

## Modelos

| Modelo                                                                       | Descrição                                                                                              |
| ---------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------ |
| [**Certificado**](docs/Modelos/certificado.md#modelo-certificado)            | Instanciação do certificado A1 (necessário para cadastro e atualização de certificado no Intima.ai)    |
| [**Documento**](docs/Modelos/documento.md#modelo-documento)                  | Instanciação de documento (necessário para protocolos em alguns tribunais)                             |
| [**Parte Vinculada**](docs/Modelos/parteVinculada.md#modelo-parte-vinculada) | Instanciação de parte vinculada (necessário para protocolos em alguns tribunais)                       |
| [**Petição**](docs/Modelos/peticao.md#modelo-petição)                        | Instanciação de petição (necessário para protocolos em alguns tribunais)                               |

## Utilidades

| Utilidade                                                                             | Descrição                                                |
| ------------------------------------------------------------------------------------- | -------------------------------------------------------- |
| [**Ação**](docs/Utilidades/acao.md#utilidade-ação)                                    | Constantes para tipos de ação                            |
| [**Dia**](docs/Utilidades/dia.md#utilidade-dia)                                       | Constantes para dias da semana                           |
| [**Horário**](docs/Utilidades/horario.md#utilidade-horário)                           | Constantes para horários                                 |
| [**Polo**](docs/Utilidades/polo.md#utilidade-polo)                                    | Constantes para polo processual (ativo/passivo)          |
| [**Tipo Declaração**](docs/Utilidades/tipoDeclaracao.md#utilidade-tipo-declaração)    | Constantes para tipos de declaração                      |
| [**Tipo Solicitação**](docs/Utilidades/tipoSolicitacao.md#utilidade-tipo-solicitação) | Constantes para tipos de solicitação                     |

## Autenticação

| Campo       | Valor            |
| ----------- | ---------------- |
| Tipo        | API Key          |
| Parâmetro   | `api_token`      |
| Localização | URL query string |
