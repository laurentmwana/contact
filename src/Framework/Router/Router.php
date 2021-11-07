<?php

namespace Framework\Router;


/**
 * Router pour controler les accès dans l'url 
 */
class Router 
{

    /**
     * @var array
     */
    private $Routes = [];

    /**
     * @var array
     */
    private $nameRoutes = [];


    /**
     * Ajoute les routes dans le tableau
     * @param string $method
     * @param string $path
     * @param callable $callback
     * @param string|null $nameRoute
     * 
     * @return Route
     */
    private function addRoutes (string $method , string $path , callable $callback , ?string $nameRoute): Route 
    {
        $route = new Route($path , $callback , $nameRoute);
        $this->Routes[$method][] = $route;
        if (!is_null($nameRoute)) {
           $this->nameRoutes[$nameRoute] = $route;
        }

        return $route;
    }

    /**
     * Requete en get
     * @param string $path
     * @param callable $callback
     * @param string|null $nameRoute
     * 
     * @return self
     */
    public function get (string $path , callable $callback , ?string $nameRoute): self
    {
        $this->addRoutes('GET',$path , $callback , $nameRoute);
        return $this;
    }

    /**
     * Requete en post
     * @param string $path
     * @param callable $callback
     * @param string|null $nameRoute
     * 
     * @return self
     */
    public function post (string $path , callable $callback , ?string $nameRoute): self
    {
        $this->addRoutes('POST',$path , $callback , $nameRoute);
        return $this;
    }


    public function run (string $url)
    {
        if (!isset($this->Routes[$_SERVER['REQUEST_METHOD']])) {
            throw new \Framework\Exceptions\RouteException("Cette methode n'existe pas");
        }

        foreach ($this->Routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($url)) {
                return $route->executes();
            }
        }

        throw new \Framework\Exceptions\RouteException("Cette route n'existe pas");


    }


    
}