# Recurso: **Protocolos**

> Você pode realizar protocolos em quase todos os tribunais diponíveis no Brasil. De
>forma rápida e segura, sem se preocupar com tamanho dos arquivos em PDF (nos ajustamos e
>recortamos automaticamente, de acordo com tribunal selecionado).
>
> Para os `protocolos no PJE ou PROJUDI`, tudo é realizado em apenas uma `única etapa`, já para os `protocolos no 
> ESAJ, EPROC e TJRJ`, são necessárias `duas etapas` para conclusão do mesmo.

Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## Exemplos

Para solicitar serviços referentes aos protocolos de habilitação, você deve instanciar o tipo de serviço antes e inserir nas funções padrões dos serviços. Veja os serviços disponíveis para os protocolos de habilitação nos exemplos abaixo.

## **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

### Geral

Exemplo para realizar uma busca geral de todas os protocolos do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Protocolo\ProtocoloBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os registros daquele serviço
    $protocolos = new ProtocoloBusca();
    
    $resultado = $intimai->servicos->buscar($protocolos); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar uma busca específica de um protocolo.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Protocolo\ProtocoloBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idProtocolo = 1; // ID do protocolo no Intima.ai
     
    $protocolo = new ProtocoloBusca($idProtocolo);
    
    $resultado = $intimai->servicos->buscar($protocolo); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Solicitação**

### PJE

Protocolos no sistema PJE são realizados em uma única etapa.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Modelos\Peticao;
use Intimai\Modelos\Documento;
use Intimai\Servicos\Solicitar\Protocolo\PJE\ProtocoloPjeSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $numeroDoProcesso = '00000000000000000000'; // Número do processo no tribunal
    
    // Estes tipos estão disponíveis no tribunal em questão, você pode buscar o tribunal e verificar os valores disponíveis.
    $tipoDocumentoMensagemGeral = 1;
    
    // A petição é obrigatória nos tribunais da Justiça do Trabalho (TRT) e proibida nos demais: fora do TRT, passe null e envie tudo em $documentos.
    // Obs: você pode buscar os tipos disponíveis da petição ao buscar o tribunal em que se está protocolando
    $peticao = new Peticao('caminho/da/peticao', 12, 'descricao-peticao');
    
    $documentos = [
        new Documento('caminho/do/documento', 1, 21, 'descricao-doc')
    ];
     
    // Obs: fora do TRT, use null no lugar de $peticao
    $protocolo = new ProtocoloPjeSolicitacao(
        $idAutenticador,
        $numeroDoProcesso,
        $tipoDocumentoMensagemGeral,
        $peticao,
        $documentos,
    );
    
    $resultado = $intimai->servicos->solicitar($protocolo); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### PROJUDI

Protocolos no sistema PROJUDI são realizados em uma única etapa.

Antes de protocolar, busque os tipos de documento mensagem geral disponíveis para o autenticador. A API responde 422 se o autenticador não for do PROJUDI e 404 se o tribunal não tiver nenhum tipo.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Protocolo\TipoDocumentoMensagemGeral\TipoDocumentoMensagemGeralProjudiBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $idAutenticador = 1; // ID do autenticador no Intima.ai

    $resultado = $intimai->servicos->buscar(new TipoDocumentoMensagemGeralProjudiBusca($idAutenticador));

    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->getStatus(), $exception->getMensagem());
}

?>
```

Depois, solicite o protocolo:

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Modelos\Documento;
use Intimai\Servicos\Solicitar\Protocolo\PROJUDI\ProtocoloProjudiSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $numeroDoProcesso = '00000000000000000000'; // Número do processo no tribunal
    
    // Um dos tipos devolvidos por TipoDocumentoMensagemGeralProjudiBusca
    $tipoDocumentoMensagemGeral = 1;
    
    $documentos = [
        new Documento('caminho/do/documento', 1, 21, 'descricao-doc')
    ];
     
    $protocolo = new ProtocoloProjudiSolicitacao(
        $idAutenticador,
        $numeroDoProcesso,
        $tipoDocumentoMensagemGeral,
        $documentos,
    );
    
    $resultado = $intimai->servicos->solicitar($protocolo); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### ESAJ

Protocolos no sistema ESAJ são realizados em duas etapas.

#### Primeira Etapa

Para realizar a primeira etapa do protocolo no sistema ESAJ, basta informar o número do processo e
o id do autenticador autenticador (contendo o tribunal referente ao número do processo).

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Solicitar\Protocolo\ESAJ\ProtocoloEsajPrimeiroPassoSolicitacao
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $numeroDoProcesso = '00000000000000000000'; // Número do processo no tribunal
     
    $primeiraEtapa = new ProtocoloEsajPrimeiroPassoSolicitacao($idAutenticador, $numeroDoProcesso);
    
    $resultado = $intimai->servicos->solicitar($primeiraEtapa); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Segunda Etapa

Após a finalização da primeira etapa, você terá que informar todas as informações principais do
protocolo:

Após a finalização da segunda etapa, a ação do protocolo estará finalizada e
você poderá ver a certidão do protocolo que contem todas as informações do protocolo e serve como
comprovante de protocolo.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Utilidades\TipoSolicitacao;
use Intimai\Utilidades\TipoDeclaracao;
use Intimai\Utilidades\Polo;
use Intimai\Modelos\ParteVinculada;
use Intimai\Modelos\Peticao;
use Intimai\Modelos\Documento;
use Intimai\Servicos\Solicitar\Protocolo\ESAJ\ProtocoloEsajSegundoPassoSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idProtocolo = 1; // ID do protocolo no Intima.ai
    
    // O id da classe pode ser obtido verificando as classes disponiveis ao buscar todas as classes
    $idClasse = 1;
    
    // O id da categoria pode ser obtido verificando as classes e categorias disponiveis ao buscar todas as classes
    $idCategoria = 1;
    
    // Array com as partes. Obs: a parte pode ter participação, verifique no tribunal
    $partesVinculadas = [
        new ParteVinculada('nome-parte'),
    ];
    
    $peticao = new Peticao('caminho/da/peticao', 12, 'descricao-peticao');
    
    $documentos = [
        new Documento('caminho/do/documento', 1, 21, 'descricao-doc')
    ];
     
    $segundaEtapa = new ProtocoloEsajSegundoPassoSolicitacao(
        $idProtocolo,
        $idClasse,
        $idCategoria,
        $partesVinculadas,
        $peticao,
        $documentos
    );
    
    $resultado = $intimai->servicos->solicitar($segundaEtapa); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### EPROC

Protocolos no sistema EPROC são realizados em duas etapas.

#### Primeira Etapa

Para realizar a primeira etapa do protocolo no sistema EPROC, basta informar o número do processo e
o id do autenticador autenticador (contendo o tribunal referente ao número do processo).

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Solicitar\Protocolo\EPROC\ProtocoloEprocPrimeiroPassoSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $numeroDoProcesso = '00000000000000000000'; // Número do processo no tribunal
     
    $primeiraEtapa = new ProtocoloEprocPrimeiroPassoSolicitacao($idAutenticador, $numeroDoProcesso);
    
    $resultado = $intimai->servicos->solicitar($primeiraEtapa); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Segunda Etapa

Após a finalização da primeira etapa, você terá que informar todas as informações principais do
protocolo:

Após a finalização da segunda etapa, a ação do protocolo estará finalizada e
você poderá ver a certidão do protocolo que contem todas as informações do protocolo e serve como
comprovante de protocolo.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Modelos\ParteVinculada;
use Intimai\Modelos\Documento;
use Intimai\Servicos\Solicitar\Protocolo\EPROC\ProtocoloEprocSegundoPassoSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idProtocolo = 1; // ID do protocolo no Intima.ai
    
    // Estes tipos estão disponíveis no protocolo, você pode buscar o protocolo e verificar os valores disponíveis.
    $tipoDocumentoMensagemGeral = 1;
    
    // Array com as partes. Obs: a parte pode ter participação, verifique no tribunal
    $partesVinculadas = [
        new ParteVinculada('nome-parte'),
    ];
    
    $documentos = [
        new Documento('caminho/do/documento', 1, 21, 'descricao-doc')
    ];
     
    $segundaEtapa = new ProtocoloEprocSegundoPassoSolicitacao(
        $idProtocolo,
        $tipoDocumentoMensagemGeral,
        $partesVinculadas,
        $documentos
    );
    
    $resultado = $intimai->servicos->solicitar($segundaEtapa); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### TJRJ

Protocolos no sistema TJRJ são realizados em duas etapas.

#### Primeira Etapa

Para realizar a primeira etapa do protocolo no sistema TJRJ, basta informar o número do processo e
o id do autenticador autenticador (contendo o tribunal referente ao número do processo).

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Solicitar\Protocolo\TJRJ\ProtocoloTjrjPrimeiroPassoSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $numeroDoProcesso = '00000000000000000000'; // Número do processo no tribunal
     
    $primeiraEtapa = new ProtocoloTjrjPrimeiroPassoSolicitacao($idAutenticador, $numeroDoProcesso);
    
    $resultado = $intimai->servicos->solicitar($primeiraEtapa); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Segunda Etapa

Após a finalização da primeira etapa, você terá que informar todas as informações principais do
protocolo:

Após a finalização da segunda etapa, a ação do protocolo estará finalizada e
você poderá ver a certidão do protocolo que contem todas as informações do protocolo e serve como
comprovante de protocolo.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Modelos\ParteVinculada;
use Intimai\Modelos\Peticao;
use Intimai\Modelos\Documento;
use Intimai\Servicos\Solicitar\Protocolo\TJRJ\ProtocoloTjrjSegundoPassoSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idProtocolo = 1; // ID do protocolo no Intima.ai
    
    // O id da classe pode ser obtido verificando as classes disponiveis ao buscar todas as classes
    $idClasse = 1;
    
    // Array com as partes. Obs: a parte pode ter participação, verifique no tribunal
    $partesVinculadas = [
        new ParteVinculada('nome-parte'),
    ];
    
    $peticao = new Peticao('caminho/da/peticao', 12, 'descricao-peticao');
    
    $documentos = [
        new Documento('caminho/do/documento', 1, 21, 'descricao-doc')
    ];
     
    // Obrigatório quando a classe escolhida tem categorias (veja as classes do protocolo)
    $idCategoria = null;

    $segundaEtapa = new ProtocoloTjrjSegundoPassoSolicitacao(
        $idProtocolo,
        $idClasse,
        $partesVinculadas,
        $peticao,
        $documentos,
        $idCategoria
    );
    
    $resultado = $intimai->servicos->solicitar($segundaEtapa); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-protocolos)        
[Voltar a lista da API](../../README.md#recursos)    
[Voltar para o README](../../README.md#intimaai--sdk-v3-php)