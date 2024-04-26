# Makefile

# Variáveis para facilitar a configuração
DC = docker-compose
ARTISAN = $(DC) exec php artisan

# Comando para iniciar todos os serviços
up:
	$(DC) up -d

# Comando para parar todos os serviços
down:
	$(DC) down

# Comando para gerar key do projeto
key-generate:
	$(ARTISAN) key:generate

# Comando para instalar dependências do Composer
composer-install:
	$(DC) run --rm composer install

# Comando para criar o projeto Laravel (usar apenas na primeira vez)
create-project:
	$(DC) run --rm composer create-project --prefer-dist laravel/laravel .
# ##################################################################

# Comando para executar as migrações
migrate:
	$(ARTISAN) migrate

# Comando para acessar o bash do container PHP
php-bash:
	$(DC) exec php /bin/bash

# Definir o comando padrão quando apenas `make` for executado
default: up
