# Recurso: **Certificados**

> Certas ações como protocolar, por exemplo, exigem que possua um `Tribunal` com o tipo de autenticação
> `Certificado A1`.
>
> Após associar um `Certificado A1` a sua conta, você deverá esperar até que o mesmo seja aprovado e
> liberado por nossa equipe.


Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## Exemplos

Para solicitar serviços referentes ao certificado, você deve instanciar o tipo de serviço antes e inserir nas funções padrões dos serviços. Veja os serviços disponíveis para o certificado nos exemplos abaixo.

### **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

#### Geral

Exemplo para realizar uma busca geral de todos os certificados do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Certificado\CertificadoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os registros daquele serviço
    $certificados = new CertificadoBusca();
    
    $resultado = $intimai->servicos->buscar($certificados); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar uma busca específica de um certificado do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Certificado\CertificadoBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idCertificado = 1; // ID do certificado no Intima.ai
    $certificado = new CertificadoBusca($idCertificado);
    
    $resultado = $intimai->servicos->buscar($certificado); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### **Solicitações**

Exemplos dos serviços disponíveis para solicitacão do cadastro, atualização ou exclusão do certificado.

#### Cadastro

Exemplo para solicitar o cadastro de um certificado.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Modelos\Certificado;
use Intimai\Servicos\SolicitarCadastro\Certificado\CertificadoSolicitacaoCadastro;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $modelCertificado = new Certificado('/caminho/certificado', 'senha');
    
    $certificado = new CertificadoSolicitacaoCadastro($modelCertificado);
    
    $resultado = $intimai->servicos->solicitarCadastro($certificado); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Atualização

Exemplo para solicitar a atualização de um certificado.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Modelos\Certificado;
use Intimai\Servicos\SolicitarAtualizacao\Certificado\CertificadoSolicitaAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idCertificado = 1; // ID do certificado no Intima.ai
    $modelCertificado = new Certificado('/caminho/certificado', 'senha');
    
    $certificado = new CertificadoSolicitaAtualizacao($idCertificado, $modelCertificado);
    
    $resultado = $intimai->servicos->solicitarAtualizacao($certificado); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Exclusão

Exemplo para solicitar a exclusão de um certificado.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\SolicitarExclusao\Certificado\CertificadoSolicitacaoExclusao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idCertificado = 1; // ID do certificado no Intima.ai
    
    $certificado = new CertificadoSolicitacaoExclusao($idCertificado);
    
    $resultado = $intimai->servicos->solicitarExclusao($certificado); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-certificados)        
[Voltar a lista da API](../../README.md#documentação-para-os-endpoints-da-api)    
[Voltar para o README](../../README.md#intimaai---sdk-v3-php)
