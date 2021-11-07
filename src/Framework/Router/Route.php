<?php

namespace Framework\Router;


/**
 * [Description Route]
 */
class Route 
{
    /**
     * Chemin de la route 
     * @var string
     */
    private  $path;

    /**
     * Action de la route 
     * @var callable
     */
    private $callback;

    /**
     * Le nom de la route 
     * @var string
     */
    private $nameRoute;

    /**
     * Enregistrer tous les matches
     * @var array
     */
    private $matches = [];


    /**
     * Route constructor
     * @param string $path
     * @param callable $callback
     * @param string|null $nameRoute
     */
    public function __construct(string $path , callable $callback , ?string $nameRoute = null)
    {
        $this->path = trim($path, '/');
        $this->callback = $callback;
        $this->nameRoute = $nameRoute;
    }

    /**
     * @param string $url
     * 
     * @return bool
     */
    public function match (string $url): bool
    {
        $url = trim($url , '/');
        $path = preg_replace("#:([\w]+)#" , "([^/]+)" , $this->path);
        $regex = "#^$path$#";
        if (preg_match($regex , $url , $matches)) {
            array_shift($matches);
            $this->matches = $matches;
            return true;
        }

        return false;
    }


    /**
     * @return mixed
     */
    public function executes ()
    {
        return call_user_func_array($this->callback , $this->matches);
    }
}