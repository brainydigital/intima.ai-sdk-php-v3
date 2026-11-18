# Modelo: **Petição**

Você pode instanciar uma petição, utilizada em métodos em que a mesma é necessária:

```php
use Intimai\Modelos\Peticao;

$peticao = new Peticao(
    'caminho/da/peticao',
    32, // Tipo do documento. Opcional (depende do tribunal)
    'descricao' // Opcional
);
```

[Voltar para o README](../../README.md#intimaai--sdk-v3-php)