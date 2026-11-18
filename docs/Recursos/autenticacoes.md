# Recurso: **Autenticacões**

> Os Autenticadores do `Intima.ai` são utilizados para ter acesso aos tribunais.
> Você pode criar diversas autenticações para diversos tribunais sendo uma autenticação para cada tribunal.
> No cadastro, `$idTribunal` aceita um id, uma lista (`[1, 2]`) ou um texto (`'1,2'`): a API cria uma autenticação para cada tribunal informado.
>
> Alguns tribunais exigem autenticação de dois fatores (2FA) no login. Para eles, informe a `secret` (Base32, mínimo de 16 caracteres) no cadastro ou depois, com [Armazenar 2FA](#armazenar-2fa-do-tribunal).
> Alguns tribunais também exigem um certificado no login por usuário/senha: nesses casos, informe `$idCertificado`.


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
    $idCertificado = null; // Opcional; obrigatório nos tribunais que exigem certificado no login regular
    
    $autenticador = new AutenticadorRegularAtualizacao($idAutenticador, $usuario, $senha, $idCertificado);
    
    $resultado = $intimai->servicos->atualizar($autenticador); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

?>
```

#### Atualizar Perfil

Exemplo para atualizar a sigla e/ou a descrição do perfil do autenticador. Informe pelo menos um dos dois.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorPerfilAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $idAutenticador = 1; // ID do autenticador no Intima.ai

    $autenticador = new AutenticadorPerfilAtualizacao($idAutenticador, 'ADV', 'Advogado');

    $resultado = $intimai->servicos->atualizar($autenticador);

    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
}

?>
```

### **Situação**

Exemplo para habilitar ou desabilitar um autenticador. Desabilitado, ele não solicita nenhuma ação até ser habilitado de novo. A API responde 422 se o autenticador já estiver na situação pedida.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorHabilitarAtualizacao;
use Intimai\Servicos\Atualizar\Autenticador\AutenticadorDesabilitarAtualizacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $idAutenticador = 1; // ID do autenticador no Intima.ai

    $resultado = $intimai->servicos->atualizar(new AutenticadorHabilitarAtualizacao($idAutenticador));
    // ou: $intimai->servicos->atualizar(new AutenticadorDesabilitarAtualizacao($idAutenticador));

    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->getStatus(), $exception->getMensagem());
}

?>
```

### **Armazenar 2FA do tribunal**

Exemplo para armazenar a `secret` do 2FA do tribunal em um ou mais autenticadores. A `secret` é a chave Base32 (letras A–Z e dígitos 2–7, mínimo de 16 caracteres) mostrada pelo tribunal ao configurar o app autenticador.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Cadastrar\Autenticador\AutenticadorDoisFatoresCadastro;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $idsAutenticadores = [1, 2]; // Um ID ou uma lista de IDs de autenticadores

    $doisFatores = new AutenticadorDoisFatoresCadastro($idsAutenticadores, 'JBSWY3DPEHPK3PXP');

    $resultado = $intimai->servicos->cadastrar($doisFatores);

    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->getErros());
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
    $idCertificado = null; // Opcional; obrigatório nos tribunais que exigem certificado no login regular
    
    $autenticador = new AutenticadorAlterarParaRegularAtualizacao($idAutenticador, $usuario, $senha, $idCertificado);
    
    $resultado = $intimai->servicos->atualizar($autenticador); 
   
    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->toJson());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
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
    
    $idTribunal = 1; // ID do tribunal no Intima.ai, ou uma lista: [1, 2]
    $oab = [
        'numero' => 'numero_valor', // Número da OAB
        'letra' => 'letra_valor', // Opcional
        'uf' => 'uf_valor' // Ex: RJ, PE, PB...
    ];
    $idCertificado = 1;
    
    $autenticador = new AutenticadorCertificadoCadastro(
        $idTribunal,
        $oab,
        $idCertificado,
        usuarioSigla: null, // Opcional
        usuarioDescricao: null, // Opcional
        secret: null // Obrigatório se algum tribunal exigir 2FA
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
        $idTribunal, // Um ID ou uma lista: [1, 2]
        $oab,
        $usuario,
        $senha,
        idCertificado: null, // Obrigatório nos tribunais que exigem certificado no login regular
        usuarioSigla: null, // Opcional
        usuarioDescricao: null, // Opcional
        secret: null // Obrigatório se algum tribunal exigir 2FA
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
    
    // Horários no qual a captura será realizada (no máximo 3)
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

#### Capturar Agora

Exemplo para pedir uma captura de intimações fora dos horários agendados. A captura do autenticador precisa estar ativa; caso contrário, a API responde 422.

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Intimai\Intimai;
use Intimai\Servicos\Solicitar\Autenticador\AutenticadorCapturarIntimacoesSolicitacao;
use Intimai\Exceptions\APIRequestException;

try {
    $intimai = new Intimai('api_token');

    $idAutenticador = 1; // ID do autenticador no Intima.ai

    $resultado = $intimai->servicos->solicitar(new AutenticadorCapturarIntimacoesSolicitacao($idAutenticador));

    var_dump($resultado);
} catch (APIRequestException $exception) {
    var_dump($exception->getStatus(), $exception->getMensagem());
}

?>
```

[Voltar ao topo](#recurso-autenticacões)        
[Voltar a lista da API](../../README.md#recursos)    
[Voltar para o README](../../README.md#intimaai--sdk-v3-php)
