# Acl Laravel

Este projeto baseado em [Docker](https://www.docker.com/) e, por isso, é necessário o ter instalado para execução do ambiente.

A pasta `./bin` possui diversos scripts utilitários, para configuração, execução e manipulação do ambiente de desenvolvimento da aplicação.

Para configurar e acessar o projeto, execute:

### Executando containers
```
./bin/composer install
```
Instala as dependências da aplicação.

```
./bin/artisan key:generate
```
Cria a chave da aplicação.

```
./bin/artisan migrate:fresh --seed
```
Instala as migrações e seeders.