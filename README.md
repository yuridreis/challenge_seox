# Teste Técnico - Seox

1- projeto_lumen: Um crud desenvolvido com lumen que abre 3 endpoints para cadastro de Imoveis, clientes e oportunidades.

2- desafio_seox: Um plugin para wordpress que sincroniza com o back-end lumen os imoveis sem oportunidades. 


## projeto_lumen

1- Instalar as dependencias

```sh
composer install
```

2- Modificar os dados do banco de dados local no arquivo .env

3- Criar as tabelas no banco de dados

```sh
php artisan migrate 
```

4- Rodar o servidor

```sh
php -S localhost:8000 -t public
```

Os endpoints estarão disponiveis para requisições http.

http://localhost:8000/imoveis

http://localhost:8000/clientes

http://localhost:8000/oportunidades

Para requisições post somente "oportunidades" espera receber dois dados, "clientes_id", "imoveis_id".

## desafio_seox

1- Adicionar o plugin na pasta wp-content/plugins/
2- Ativar o plugin pelo painel administrativo

Caso o back-end lumen não esteja rodando o plugin dara um erro ao tentar ser ativado pois não conseguira sincronizar os posts