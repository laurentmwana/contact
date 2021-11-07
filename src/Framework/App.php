<?php

namespace Framework;


class App 
{
    /**
     * @var \Framework\Router\Router
     */
    private $route;

    /**
     * charger tous les modules
     * @var array
     */
    private $module = [];


    
    /**
     * @param array $modules
     * @param array $dependencies
     */
    public function __construct(array $modules, array $dependencies = [])
    {
        $this->route = new \Framework\Router\Router();
        if (array_key_exists('renderer', $dependencies)) {
            $renderer = $dependencies['renderer'];
        }
        foreach ($modules as $module) {
            $this->module = new $module($this->route, $renderer);
        }
    }


    /**
     * @param string $url
     * 
     * @return mixed
     */
    public function start (string $url)
    {
        $this->route->run($url);
    }
}