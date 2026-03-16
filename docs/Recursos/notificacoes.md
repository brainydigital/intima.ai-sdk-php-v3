# Recurso: **Notificações**

> Atravez deste recurso você poderá ter o controle de todos os outros emails em que se deseja
> receber notificações, além do seu email principal.


Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## Exemplos

Para solicitar serviços referentes as notificações, você deve instanciar o tipo de serviço antes e inserir nas funções padrões dos serviços. Veja os serviços disponíveis para as notificações nos exemplos abaixo.

## Notificação por Email

### **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

#### Geral

Exemplo para realizar uma busca geral de todas as notificações por email do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Notificacao\NotificacaoEmailBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os
    // registros daquele serviço
    $notificacoesEmail = new NotificacaoEmailBusca();
    
    $resultado = $intimai->servicos->buscar($notificacoesEmail); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar uma busca específica de uma noticação por email.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Notificacao\NotificacaoEmailBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idNotificacaoEmail = 1; // ID da notificação por email no Intima.ai
     
    $notificacaoEmail = new NotificacaoEmailBusca($idNotificacaoEmail);
    
    $resultado = $intimai->servicos->buscar($notificacaoEmail); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### **Cadastro**

Exemplo para realizar o cadastro de uma notificação por email.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Cadastrar\Notificacao\NotificacaoEmailCadastro;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $email = 'email@exemplo.com';
     
    $notificacaoEmail = new NotificacaoEmailCadastro($email);
    
    $resultado = $intimai->servicos->cadastrar($notificacaoEmail); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### **Atualização**

Exemplo para realizar a atualização de uma notificação por email.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Atualizar\Notificacao\NotificacaoEmailAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
     
    $idNotificacaoEmail = 1; // ID da notificação por email no Intima.ai
    $novoEmail = 'email-novo@exemplo.com';
     
    $notificacaoEmail = new NotificacaoEmailAtualizacao($idNotificacaoEmail, $novoEmail);
    
    $resultado = $intimai->servicos->atualizar($notificacaoEmail); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### **Exclusão**

Exemplo para realizar a exclusão de uma notificação por email.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Excuir\Notificacao\NotificacaoEmailExclusao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
     
    $idNotificacaoEmail = 1; // ID da notificação por email no Intima.ai
     
    $notificacaoEmail = new NotificacaoEmailExclusao($idNotificacaoEmail);
    
    $resultado = $intimai->servicos->excluir($notificacaoEmail); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

## Notificação por Webhook

### **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

#### Geral

Exemplo para realizar uma busca geral de todas as notificações por webhook do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Notificacao\NotificacaoWebhookBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os
    // registros daquele serviço
    $notificacoesWebhook = new NotificacaoWebhookBusca();
    
    $resultado = $intimai->servicos->buscar($notificacoesWebhook); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar uma busca específica de uma noticação por webhook.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Notificacao\NotificacaoWebhookBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idNotificacaoWebhook = 1; // ID da notificação por webhook no Intima.ai
     
    $notificacaoWebhook = new NotificacaoWebhook($idNotificacaoWebhook);
    
    $resultado = $intimai->servicos->buscar($notificacaoWebhook); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### **Cadastro**

Exemplo para realizar o cadastro de uma notificação por webhook.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Cadastrar\Notificacao\NotificacaoWebhookCadastro;
use Intimai\Utilidades\Acao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $tipoAcao = Acao::TIPO_COPIA;
    $verboHttp = 'GET';
    $url = 'url-exemplo.com';
     
    $notificacaoWebhook = new NotificacaoWebhookCadastro($tipoAcao, $verboHttp, $url);
    
    $resultado = $intimai->servicos->cadastrar($notificacaoWebhook); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### **Atualização**

Exemplo para realizar a atualização de uma notificação por webhook.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Utilidades\Acao;
use Intimai\Servicos\Atualizar\Notificacao\NotificacaoWebhookAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
     
    $idNotificacaoWebhook = 1; // ID da notificação por webhook no Intima.ai
    $novoTipoacao = Acao::TIPO_INFORMACAO;
    $novoVerboHttp = 'POST';
    $novaUrl = 'nova-url-exemplo.com';
     
    $notificacaoEmail = new NotificacaoWebhookAtualizacao($idNotificacaoWebhook, $tipoAcao, $novoVerboHttp, $novaUrl);
    
    $resultado = $intimai->servicos->atualizar($notificacaoEmail); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### **Exclusão**

Exemplo para realizar a exclusão de uma notificação por webhook.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Excuir\Notificacao\NotificacaoWebhookExclusao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
     
    $idNotificacaoWebhook = 1; // ID da notificação por webhook no Intima.ai
     
    $notificacaoWebhook = new NotificacaoWebhookExclusao($idNotificacaoWebhook);
    
    $resultado = $intimai->servicos->excluir($notificacaoWebhook); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-notificações)        
[Voltar a lista da API](../../README.md#documentação-para-os-endpoints-da-api)    
[Voltar para o README](../../README.md#intimaai---sdk-v3-php)
