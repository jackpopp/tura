# Tura

### Use laravel named routes in your javascript.

Register named routes in routes.php and add they key **tura** with the value true to the options array.
Tura will only expose routes which have been set to be exposed.

```php 
Route::get('/', array(
    'uses' => 'HomeController@index',
    'as'   => 'home',
    'tura' => true
));

Route::get('user', array(
    'uses' => 'HomeController@index',
    'as'   => 'user.create'
));

Route::get('user/{id}', array(
    'uses' => 'HomeController@index',
    'as'   => 'user.show',
    'tura' => true
));
```

You can now access your exposed named routes as a JSON object by calling the fetch routes method (this could be called
in your master blade layout for example).

```php
Tura::fetchRoutes();
```

The named routes will now be available in the javascript global scope by calling the **tura** object
```javascript
console.log(tura)
Object {home: "/", user.show: "user/{id}"}
console.log(tura['user.show'])
"user/{id}"
```

Install via composer add to require in composer.json

```javacript
"jackpopp/tura": "dev-master"
```

Add the service provider and class alias to app.php config (found in app/config/app.php)

Add to the providers array

```php
'Jackpopp\Tura\TuraServiceProvider',
```

Add to the aliases array

```php
'Tura' => 'Jackpopp\Tura\TuraServiceProvider',
```
