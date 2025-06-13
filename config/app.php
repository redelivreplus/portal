<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | Nome da aplicação, usado em notificações e outras exibições.
    |
    */

    'name' => env('APP_NAME', 'REDE LIVRE'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | Define o ambiente de execução da aplicação.
    | Valores comuns: local, production, staging, testing
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | Habilita/desabilita o modo debug para mensagens de erro detalhadas.
    | Nunca deixe habilitado em produção.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | URL base para a aplicação, usada em comandos artisan e geração de URLs.
    | Configure corretamente para gerar links corretos.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Define o timezone padrão para funções de data/hora em PHP e Laravel.
    | Use um timezone válido do PHP (ex: https://www.php.net/manual/en/timezones.php).
    | Aqui mantemos o horário oficial de Brasília.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'America/Sao_Paulo'),

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | Define o locale padrão da aplicação para tradução e formatação.
    | Use apenas "pt" para português do Brasil, pois é o padrão esperado pelo Laravel.
    | Pode usar pt_BR se tiver certeza que as traduções suportam.
    |
    */

    'locale' => env('APP_LOCALE', 'pt'),

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | Locale usado quando o locale padrão não estiver disponível.
    | Normalmente mantemos igual ao locale principal.
    |
    */

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'pt'),

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | Locale padrão para a biblioteca Faker, utilizada em seeds e testes.
    | Usamos pt_BR para dados falsos brasileiros.
    |
    */

    'faker_locale' => 'pt_BR',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | Chave para criptografia usada pelo Laravel, deve ser uma string de 32 caracteres.
    | Gere usando `php artisan key:generate` e defina no .env
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Previous Encryption Keys
    |--------------------------------------------------------------------------
    |
    | Chaves anteriores para criptografia, caso use rotacionamento de chaves.
    | Caso não use, deixe vazio.
    |
    */

    'previous_keys' => array_filter(
        explode(',', env('APP_PREVIOUS_KEYS', ''))
    ),

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | Driver para modo manutenção da aplicação.
    | Pode ser 'file' (padrão) ou 'cache', etc.
    | Store pode ser 'file' ou 'database' se for cache driver.
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'file'),
    ],

];
