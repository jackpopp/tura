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

You can now access your exposed named routes as a JSON object by calling the fetch routes method

```php
Tura::fetchRoutes();
```

The named routes will now be available in global scope by call the **tura** object
```javascript
console.log(tura)
Object {home: "/", user.show: "user/{id}"}
```
