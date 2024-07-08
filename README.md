### Instale as dependencia 

composer install

### Configure database

Edite o arquivo `config/db.php`, escreva os dados do banco local:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => '',
    'password' => '',
    'charset' => 'utf8',
];
```
### Cadastrando usuario

Utilize o comando:
    php yii new-user username password

O comando retorna um json com as informações do usuário, utilize authKey para ter acesso aos demais endpoints.

### Utilizando endpoints

-> Clientes

GET /customer

Retorna todos os clientes, 5 itens por pagina.

GET /customer/1

Retorna cliente de acordo com id.

DELETE /customer/1

Remove cliente de acordo com id.

PUT /customer/1

Edita cliente especificado.

```php
	{
		"name": "Carlos",
		"cpf": "183.628.800-07",
		"photo": "5b1b2849-1854-451f-bc3e-2610c5f9d486.png",
		"sex": "M"
	},
```

POST /customer

Para cadastrar novos clientes use o objeto:

```php
	{
		"name": "Carlos",
		"cpf": "183.628.800-07",
		"photo": "5b1b2849-1854-451f-bc3e-2610c5f9d486.png",
		"sex": "M"
	},
```
O campos cpf deve esta no formato XXX.XXX.XXX-XX.

-> Produto

GET /product

Retorna todos os produtos, 5 itens por pagina.

GET /product/1

Retorna produto de acordo com id.

DELETE /product/1

Remove produto de acordo com id.

PUT /product/1

Edita produto especificado.

```php
	{
		"customer_id": 1,
		"name": "carro",
		"value": "50000.00",
		"photo": "5b1b2849-1854-451f-bc3e-2610c5f9d486.png"
	},
```

POST /product

Para cadastrar novos produtos use o objeto:

```php
	{
		"customer_id": 1,
		"name": "carro",
		"value": "50000.00",
		"photo": "5b1b2849-1854-451f-bc3e-2610c5f9d486.png"
	},
```
Voce deve especificar o id do cliente que possui o produto.

-> Endereço

GET /address

Retorna todos os endereços, 5 itens por pagina.

GET /address/1

Retorna endereço de acordo com id.

DELETE /address/1

Remove endereço de acordo com id.

PUT /address/1

Edita endereço especificado.

```php
	{
		"customer_id": 1,
		"cep": "00000-000",
		"street": "Rua 00",
		"number": "00",
		"city": "Cidade 00",
		"state": "Estado 00",
		"complement": "Complemento"
	},
```

POST /address

Para cadastrar novos endereços use o objeto:

```php
	{
		"customer_id": 1,
		"cep": "00000-000",
		"street": "Rua 00",
		"number": "00",
		"city": "Cidade 00",
		"state": "Estado 00",
		"complement": "Complemento"
	},
```
Voce deve especificar o id do cliente que tem esse endereço.
