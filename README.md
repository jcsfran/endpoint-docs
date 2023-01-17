# Swagger

## Descrição

Padroniza a documentação das rotas do projeto e cria os arquivos da documentação através do terminal. Os arquivos criados são do tipo **.yaml**.

Desenvolvido para o [Laravel](https://laravel.com/). Esse pacote usa como base o [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger).

## Instalação
```console
composer require julio/swagger
```

Após a instalação do pacote, será preciso publicar os arquivos para que a documentação funcione

```console
php artisan vendor:publish --provider "Julio\Swagger\Src\DocumentationServiceProvider"

```
![image](https://user-images.githubusercontent.com/87837834/212961051-89acb1ef-ff52-4bdb-ae41-e927cd1c6e24.png)

### Configurações
Altere os arquivos de `documentation.php` ou `l5-swagger.php`

#### Rota de acesso
Para configurar o nome da rota de acesso da documentação, entre no arquivo `l5-swagger.php` e altere
```php
'routes' => [
  'api' => rotaDeAcesso
]
```
#### Middleware de segurança
Adicione o middleware de segurança na variável `$routeMiddleware` em `Http/Kernel.php`
```php
'access_docs' => \Julio\EndpointDocs\Src\ValidateAccessDocumentationRoute::class,
```
Acesse o arquivo `l5-swagger.php` e adicione o `access_docs`
```php
'middleware' => [
  'api' => ['access_docs'],
],
```
No arquivo de rotas `web.php` adicione a rota e sua view
```php
Route::view('/access-docs', 'api-docs.docs')
    ->name('access-docs');
```
E adicione a variável `DOCS_KEY` na .env com a sua senha da documentação

## Começando
Os nomes dos arquivos .yaml utilizam o mesmo padrão do nomes dos métodos do controller (index, store, show, update e destroy), esses nomes são chamados de `Actions` nesta documentação.

- A index e a show utilizam o método `GET`
- O store utiliza o método `POST`
- O upate utiliza o método `PUT`
- O destroy utiliza o método `DELETE`

Cada **Action** possui sua configuração base de arquivo.

## Comandos
Use um dos comandos abaixo para criar um arquivo chamado **actions.yaml**, utilize o caminho retornado no terminal e o coloque como referência na área de **paths**
``` yaml
paths:
  /caminhoDaRota:
    $ref: caminhoDoArquivo/actions.yaml
```
### Comandos básicos
- `php artisan docs:route route store` cria somente o método store
- `php artisan docs:route route index` cria somente o método index
- `php artisan docs:route route show` cria somente o método show
- `php artisan docs:route route update` cria somente o método update
- `php artisan docs:route route destroy` cria somente o método destroy

### Parâmetros
Utilize o `:` para indicar o nome do parâmetro, pode ser adicionado mais de um parâmetro

Quando um parâmetro é informado, ele é adicionado automaticamente na Action que o acompanha

- `php artisan docs:route route/:id show`

Estrutura da pasta
```
 ------------------
|- route
|-- id
|--- actions.yaml
|--- show.yaml
 ------------------
```

### Autenticação
Adicione o `--auth` para indicar que a rota precisa de um token de autenticação para ser utilizada pelo front-end

- `php artisan docs:route route show --auth`

### Comando completo
- `php artisan docs:route route/:id index store show update destroy --auth` comando completo

Estrutura da pasta
```
 ------------------
|- route
|-- id
|--- actions.yalm
|--- index.yalm
|--- store.yalm
|--- show.yalm
|--- update.yalm
|--- destroy.yalm
 ------------------
```

### Observações
Não é possível ter dois arquivos com o mesmo método na mesma pasta. Então a **index** e a **show** não podem ficar na mesma pasta e no mesmo arquivo **actions.yalm**

### Actions

- `index` gera um arquivo com o método get e com o retorno paginado
- `show` gera um arquivo com o método get e com o os status corretos de uma show
- `store` gera um arquivo com o método post e com o as validações da requisição, exemplos de requisições e com seu status code 201
- `update` gera um arquivo com o método put e com o as validações da requisição, exemplos de requisições e com seu status code 204
- `destroy` gera um arquivo com o método delete e com o status code 204

### Renomear os nomes dos arquivos
- `php artisan docs:route route/:id store --name=login` gera um arquivo com o método post, mas com o nome login.yaml
- `php artisan docs:route route/:id store show --name=login --name=me` gera um arquivo com o método post, mas com o nome login.yaml e um arquivo no método get com o nome me.yaml

Cada nome deve ser passado utilizando o `--name=` e na mesma ordem que foi informado as actions

Se o nome não é informado, o arquivo ficará com o nome da Action

### Auth
Por padrão os métodos que serão autenticados precisam estar acompanhados do `--auth` ou `-a`

Quando for informado, o código de autenticação sera inserido na Action informada

- `php artisan docs:route routePath index store show update destroy --a` adiciona o autenticador nos arquivos de cada Action informada
- `php artisan docs:route routePath index -a` adiciona o autenticador somente no método informado

## Notas de atualização
As notas de atualização servem para armazenar o histórico de atualização de sua documentação

### Como rodar
- `php artisan docs:patch nome` irá criar estrutura da nota de atualização
- `php artisan docs:patch nome --routes=2` irá a estrutura da nota de atualização com descrição para duas rotas