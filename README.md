# Desafio de desenvolvimento
Para executar o projeto será necessário fazer o clone do mesmo do GitHub

```SHELL
git clone git@github.com:franverfsm/libraries.git <nome_diretorio>
```

Após o clone do repositório acessar o diretório que você colocou o projeto

```SHELL
cd nome_diretorio
```

Agora vamos iniciar os conteiners do docker, utilizando o seguinte comando:

```SHELL
docker compose up -d
```

Nessa etapa vamos fazer as instalações e configurações necessárias para rodar o projeto

Clonando o arquivo .env
```SHELL
cp ./src/.env.example ./src/.env
```

Rodando o composer o install
```SHELL
docker compose exec app composer install
```

Gerando a key do projeto laravel
```SHELL
docker compose exec app php artisan key:generate
```

Rodando migrate e seeser para criar as primeiras tabelas e dados necessárias
```SHELL
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```

Após o processo será necessário restartar os conteiners
```SHELL
docker compose restart
```
