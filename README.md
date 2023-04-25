# Documentação de como rodar o projeto

## Configuração inicial

* Será necessária a criação de um arquivo .env adicionando o parametro ASAAS_API_KEY, seu valor é disponibilizado pela ASASS


* Também necessário a alteração dos valores para acesso ao banco de dados, sendo eles no arquivo .env que pode ser criado a partide do .env.example:

`DB_HOST=db`

`DB_PORT=3306`

`DB_DATABASE=perfectpay`

`DB_USERNAME=root`

`DB_PASSWORD=root`

## Subindo os containers

Com o terminal no diretório perfectpay-desafio é possivel iniciar os containers usados no projeto com o comando `docker-compose up`

## Preparando o banco de dados

Pode-se utlizar o comando `php artisan migrate:refresh --seed` que irá remover recriar qualquer instancia do banco previamente criada, criar as tabelas e popula-las com dados

Obs.: caso esses comandos `php artisan` apresentem falha, pode-se alterar o arquivo .env, na entrada `DB_HOST=db` para `DB_HOST=127.0.0.1`

## Acessando o sistema

Uma vez tudo preparado, pode-se acessar o sistema e utiliza-lo  a partir do navegador pelo endereço `http://localhost:8000/`

### Cobertura de testes

Visualizando o arquivo index.html no navegador, localizado no diretório `/coverage/`, apresenta a cobertura para os testes criados
