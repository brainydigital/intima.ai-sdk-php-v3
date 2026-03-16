# Recurso: **Autenticacões**

> Os Autenticadores do `Intima.ai` são utilizados para ter acesso aos tribunais.
> Você pode criar diversas autenticações para diversos tribunais sendo uma autenticação para cada tribunal.


Todas as URIs são relativas a *https://app.intima.ai/api/v3*

## Exemplos

Para solicitar serviços referentes ao autenticador, você deve instanciar o tipo de serviço antes e inserir nas funções padrões dos serviços. Veja os serviços disponíveis para o autenticador nos exemplos abaixo.

### **Busca**

> Obs: Lembre-se que é possível paginar ou aplicar filtros as buscas dos serviços.

#### Geral

Exemplo para realizar uma busca geral de todas as autenticações do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Autenticador\AutenticadorBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // Se não for inserido nenhum id no serviço busca, ele irá retornar todos os registros daquele serviço
    $autenticadores = new AutenticadorBusca();
    
    $resultado = $intimai->servicos->buscar($autenticadores); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Específica

Exemplo para realizar uma busca específica de uma autenticação do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Buscar\Autenticador\AutenticadorBusca;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $autenticador = new AutenticadorBusca($idAutenticador);
    
    $resultado = $intimai->servicos->buscar($autenticador); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### **Dados**

Exemplos dos serviços disponíveis para atualização dos dados.

#### Atualizar Dados OAB

Exemplo para realizar a atualização dos dados referentes a OAB do autenticador específico do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorOabAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $oab = [
        'numero' => 'numero_valor', // Número da OAB
        'letra' => 'letra_valor', // Opcional
        'uf' => 'uf_valor' // Ex: RJ, PE, PB...
    ];
    
    $autenticador = new AutenticadorOabAtualizacao($idAutenticador, $oab);
    
    $resultado = $intimai->servicos->atualizar($autenticador); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Atualizar Dados Usuário/Senha

Exemplo para realizar a atualização dos dados referentes ao usuário/senha (obrigatório ser do tipo regular) do autenticador específico do usuário.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorRegularAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $usuario = 'usuario-novo-valor'; // Opcional se estiver alterando apenas a senha
    $senha = 'senha-nova-valor'; // Opcional se estiver alterando apenas o úsuario
    
    $autenticador = new AutenticadorRegularAtualizacao($idAutenticador, $usuario, $senha);
    
    $resultado = $intimai->servicos->atualizar($autenticador); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

### **Tipo**

Exemplos dos serviços disponíveis para criar autenticadores ou alterar o autenticador de Certificado para Regular e vice-versa.

#### Alterar para Usuário/Senha

Exemplo para realizar a alteração do tipo do autenticador para usuário/senha (obrigatório o autenticador ser previamente do tipo Certificado A1).

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorAlterarParaRegularAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $usuario = 'usuario-valor'; // Usuário que será utilizado para acesso ao tribunal
    $senha = 'senha-valor'; // Senha que será utilizada para acesso ao tribunal
    
    $autenticador = new AutenticadorAlterarParaRegularAtualizacao($idAutenticador, $usuario, $senha);
    
    $resultado = $intimai->servicos->atualizar($autenticador); 
   
    var_var_dump($resultado);
} catch (APIRequestException $exception) {
    var_var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_var_dump($exception->getMessage());
}

?>
```

#### Alterar para Certificado

Exemplo para realizar a alteração do tipo do autenticador para certificado A1 (obrigatório o autenticador ser previamente do tipo usuário/senha).

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorAlterarParaCertificadoAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idAutenticador = 1; // ID do autenticador no Intima.ai
    $idCertificado = 1; // ID do certificado no Intima.ai
    
    $autenticador = new AutenticadorAlterarParaCertificadoAtualizacao($idAutenticador, $idCertificado);
    
    $resultado = $intimai->servicos->atualizar($autenticador); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Criar com Certificado

Exemplo para realizar o cadastro de um autenticador do tipo certificado A1.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Cadastrar\Autenticador\AutenticadorCertificadoCadastro;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idTribunal = 1; // ID do tribunal no Intima.ai
    $oab = [
        'numero' => 'numero_valor', // Número da OAB
        'letra' => 'letra_valor', // Opcional
        'uf' => 'uf_valor' // Ex: RJ, PE, PB...
    ];
    $idCertificado = 1;
    
    $autenticador = new AutenticadorCertificadoCadastro($idTribunal, $oab, $idCertificado);
    
    $resultado = $intimai->servicos->cadastrar($autenticador); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Criar com Usuário/Senha

Exemplo para realizar o cadastro de um autenticador do tipo regular (usuário/senha).

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Cadastrar\Autenticador\AutenticadorRegularCadastro;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    $idTribunal = 1; // ID do tribunal no Intima.ai
    $oab = [
        'numero' => 'numero_valor', // Número da OAB
        'letra' => 'letra_valor', // Opcional
        'uf' => 'uf_valor' // Ex: RJ, PE, PB...
    ];
    $usuario = 'usuario-valor'; // Usuário que será utilizado para acesso ao tribunal
    $senha = 'senha-valor'; // Senha que será utilizada para acesso ao tribunal
    
    $autenticador = new AutenticadorRegularCadastro(
        $idTribunal,
        $oab,
        $usuario,
        $senha
    );
    
    $resultado = $intimai->servicos->cadastrar($autenticador); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```
### **Intimação**

Exemplos dos serviços disponíveis ativar/desativar captura de intimações do autenticador.

#### Ativar Captura

Exemplo para ativar a captura de intimações de um autenticador.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorAtivarCapturaIntimacaoAtualizacao;
use Intimai\Utilidades\Dia;
use Intimai\Utilidades\Horario;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // ID do autenticador no Intima.ai
    $idAutenticador = 1; 
    
    // Abas disponíveis no tribunal para o qual você está ativando a captura.
    $abas = [
        'aba_1',
        'aba_2'
    ];
    
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
    
    // Por padrão, este valor é 0 (false), se quiser ativar, basta definir como 1 (true)
    $capturarProcuradorias = 1; 
    
    $autenticador = new AutenticadorAtivarCapturaIntimacaoAtualizacao(
        $idAutenticador,
        $abas,
        $diasDeCaptura,
        $horariosDeCaptura,
        $capturarProcuradorias
    );
    
    $resultado = $intimai->servicos->atualizar($autenticador); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Desativar Captura

Exemplo para desativar a captura de intimações de um autenticador.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorDesativarCapturaIntimacaoAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');
    
    // ID do autenticador no Intima.ai
    $idAutenticador = 1;
    
    $autenticador = new AutenticadorDesativarCapturaIntimacaoAtualizacao($idAutenticador);
    
    $resultado = $intimai->servicos->atualizar($autenticador); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

[Voltar ao topo](#recurso-autenticacões)        
[Voltar a lista da API](../../README.md#documentação-para-os-endpoints-da-api)    
[Voltar para o README](../../README.md#intimaai---sdk-v3-php)
