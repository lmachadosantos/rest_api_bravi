## First step

```
git clone https://github.com/lmachadosantos/rest_api_bravi.git
```

## Configure database

Create your database and edit the application/config/database.php file with your settings
```
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '123456',
	'database' => 'rest_api_bravi',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
```

## Second step
```
php -sS localhost:9999
```

## Third step
Access the URL to run the migrate
```
http://localhost:9999/migrate
```

## Fourth step
Consult people
```
METHOD: GET
URL: http://localhost:9999/people/get/
```

Consult people by id
```
METHOD: GET
URL: http://localhost:9999/people/get/{id}
```

Add people (TYPE: R=residential, C=cell phone, W=whatsapp)
```
METHOD: POST
URL: http://localhost:9999/people/add/
BODY: 
{
	"name": "Leandro Machado dos Santos",
	"emails": [
			{
				"email": "lmachadosantos@gmail.com"
			}, 
			{
				"email": "lmachadosantos@icloud.com"
			}
		],
	"phones": [
			{
				"type": "R",
				"number": 1127210945
			},
			{
				"type": "C",
				"number": 11987755990
			},
			{
				"type": "W",
				"number": 11987755990
			}
		]
}
```

Edit people (TYPE: R=residential, C=cell phone, W=whatsapp)
```
METHOD: PUT
URL: http://localhost:9999/people/update/{id}
BODY: 
{
	"name": "Leandro Machado dos Santos",
	"emails": [
			{
				"email": "lmachadosantos@icloud.com"
			}
		],
	"phones": [
			{
				"type": "C",
				"number": 11987755990
			},
			{
				"type": "W",
				"number": 11987755990
			}
		]
}
```

Delete people
```
METHOD: DELETE
URL: http://localhost:9999/people/delete/{id}
```