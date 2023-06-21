# ZAY-Framework
Estrutura simples PHP MVC. Desenvolvida em 2022, faz uso do Composer para gerenciar as dependência e foi projetada para ser muito simples de usar. Inspirado no Laravel.

# Requisitos
* PHP >= 7.3.0
* MySQL >= 5.6.10
* Composer

# Como instalar
Nota: Recomenda-se que você instale o LAMP.

Clone o repositório

```
git clone https://github.com/gomes2191/
```

Acesse o diretório do repositório

```
cd PHP-MVC-Framework
```

Executar o composer para instalar quaisquer dependências php

```
composer install
```

Acesse o diretório public

```
cd public
```

Start o PHP server (0.0.0.0 é o padrão route, isso faz o PHP ouvir em todos os IPv4 interfaces)

```
php -S 0.0.0.0:8000
```

Visite o IP address (127.0.0.1 se você está executando Linux nativamente, ou o endereço IP do sua VM/VPS/etc) http://127.0.0.1:8000 em seu navegador web.

Para executar os testes unitários incluídos, certifique-se de que você ainda está no diretório public, e, em seguida, digite o seguinte comando

```
../vendor/bin/phpunit ../tests
```
