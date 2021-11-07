<?php

namespace Framework;


/**
 * Charger le bon ficher du vue 
 */
class Renderer 
{
    /**
     * créer  des variables globales et l'injecter dans le vue
     * @var array
     */
    private $Globals = [];

    /**
     * Chemin principale pour charger le vue+
     * @var string
     */
    private $namespace;



    /**
     * Renderer Constructor
     * @param string $namespace
     */
    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;
    }


    /**
     * @param string $path
     * @param array $params
     * 
     * @return void
     */
    public function render (string $path , string $template = 'layout',  ?array $params = null): void
    {
        $paths = $this->namespace . str_replace('@', DIRECTORY_SEPARATOR , $path);
        ob_start();
        if (!is_null($params)) {
            extract($params);
        }
        extract($this->Globals);
        
        require $paths . '.php';
        

        $content = ob_get_clean();
        require $this->namespace . 'layout' .  DIRECTORY_SEPARATOR .  $template . '.php';
    }





    /**
     * @param mixed $key
     * @param mixed $value
     * 
     * @return mixed
     */
    public function Globals ($key , $value)
    {
        $this->Globals[$key] = $value;
    }
}