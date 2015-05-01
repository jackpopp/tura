<?php namespace Jackpopp\Tura;

use Illuminate\Foundation\Application;
use ReflectionClass;

class Tura {

    protected $app;
    protected $routes = array();

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function setRoutes($routes)
    {
        $this->routes = $routes;
        return $this;
    }

    /**
     * Grabs named routes with tura flag set to true and echos a json object with names as key and uri as values
     */

    public function fetchRoutes()
    {
        $nameList = $this->fetchRouteCollectionNameList();

        $this->setRoutes($this->resolveExposedRoutes($nameList));

        $routes = json_encode($this->getRoutes());

        return View::make('tura::tura.javascript');
    }

    /**
     * Fetches the nameList from Laravel's RouteCollection Object
     * @return mixed
     */

    public function fetchRouteCollectionNameList()
    {
        $reflection = new ReflectionClass('Illuminate\Routing\RouteCollection');
        $prop = $reflection->getProperty('nameList');
        $prop->setAccessible(true);

        return $prop->getValue($this->app['router']->getRoutes());
    }

    /**
     * Iterates through routes and adds routes that have been set to be exposed as named routes in javascript
     * @param $values
     * @return array
     */

    public function resolveExposedRoutes($values)
    {
        $routes = array();

        foreach ($values as $key => $value)
        {
            $action = $value->getAction();

            if ( (array_key_exists('tura', $action)) && ($action['tura']) )
                $routes[$key] = $value->getPath();
        }

        return $routes;
    }

} 
