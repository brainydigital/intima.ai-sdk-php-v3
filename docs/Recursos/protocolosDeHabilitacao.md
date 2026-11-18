# Recurso: **Protocolos De Habilitação**

> Assim como os protocolos, você realizar protocolos de habilitação em quase todos os tribunais
> diponíveis no Brasil. Sem se preocupar com tamanho dos arquivos em PDF (nos ajustamos e
> recortamos automaticamente, de acordo com tribunal selecionado).
>
> O protocolo habilitação é realizado em duas etapas:
>
> - Primeira etapa: Coleta de informações do processo no qual se deseja solicitar habilitação.
> - Segunda etapa: Realização do protocolo, a partir das informações coletadas na etapa anterior.

Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## Exemplos

Para solicitar serviços referentes aos protocolos de habilitação, você deve instanciar o tipo de serviço antes e inserir nas funções padrões dos serviços. Veja os serviços disponíveis para os protocolos de habilitação nos exemplos abaixo.

## **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

### Geral

Exemplo para realizar uma busca geral de todas os protocolos habilitação do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\ProtocoloHabilitacao\ProtocoloHabilitacaoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os registros daquele serviço
    $protocolosHabilitacao = new ProtocoloHabilitacaoBusca();
    
    $resultado = $intimai->servicos->buscar($protocolosHabilitacao); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar uma busca específica de um protocolo habilitação.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\ProtocoloHabilitacao\ProtocoloHabilitacaoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idProtocoloHabilitacoa = 1; // ID do protocolo habilitação no Intima.ai
     
    $protocoloHabilitacao = new ProtocoloHabilitacaoBusca($idProtocoloHabilitacoa);
    
    $resultado = $intimai->servicos->buscar($protocoloHabilitacao); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## **Solicitação**

### Primeira etapa

Para realizar a primeira etapa do protocolo de habilitação, basta informar o número do processo e
o id do autenticador autenticador (contendo o tribunal referente ao número do processo).

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Solicitar\ProtocoloHabilitacao\PJE\ProtocoloHabilitacaoPjePrimeiroPassoSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $numeroDoProcesso = '00000000000000000000'; // Número do processo no tribunal
     
    $primeiraEtapa = new ProtocoloHabilitacaoPjePrimeiroPassoSolicitacao($idAutenticador, $numeroDoProcesso);
    
    $resultado = $intimai->servicos->solicitar($primeiraEtapa); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### Segunda etapa

Após a finalização da primeira etapa, você terá que informar todas as informações principais do
protocolo de habilitação:

Após a finalização da segunda etapa, a ação do protocolo de habilitação estará finalizada e
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
use Intimai\Modelos\Documento;
use Intimai\Servicos\Solicitar\ProtocoloHabilitacao\PJE\ProtocoloHabilitacaoPjeSegundoPassoSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idProtocoloHabilitacao = 1; // ID do protocolo habilitação no Intima.ai
    
    // Estes tipos estão disponíveis no enum TipoSolicitacao
    $tipoSolicitacao = TipoSolicitacao::HABILITACAO_SIMPLES;
    
    // Estes tipos estão disponíveis no enum TipoDeclaracao (constantes TRT_* para a Justiça do Trabalho)
    $tipoDeclaracao = TipoDeclaracao::DECLARACAO_SOB_PENA_DE_LEI;
    
    // Estes polos estão disponíveis no enum Polo
    $polo = Polo::ATIVO;
    
    // Partes do polo escolhido: use o "nome" de cada parte em extra.processo_polos (polo_ativo ou polo_passivo)
    // do protocolo de habilitação. Aceita ParteVinculada ou o nome direto.
    $partesVinculadas = [
        new ParteVinculada('nome-parte'),
        'outra-parte',
    ];
    
    // Estes tipos estão disponíveis no protocolo, você pode buscar o protocolo e verificar os valores disponíveis.
    $tipoDocumentoMensagemGeral = 1;

    $descricao = 'descricao'; // Opcional
    $mensagemGeral = 'mensagem-geral'; // Opcional
    
    $documentos = [
        new Documento('caminho/do/documento', 1, 21, 'descricao-doc')
    ];
     
    $segundaEtapa = new ProtocoloHabilitacaoPjeSegundoPassoSolicitacao(
        $idProtocoloHabilitacao,
        $tipoSolicitacao,
        $tipoDeclaracao,
        $polo,
        $partesVinculadas,
        $tipoDocumentoMensagemGeral,
        $descricao,
        $mensagemGeral,
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

[Voltar ao topo](#recurso-protocolos-de-habilitação)        
[Voltar a lista da API](../../README.md#recursos)    
[Voltar para o README](../../README.md#intimaai--sdk-v3-php)