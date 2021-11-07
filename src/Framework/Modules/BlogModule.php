<?php

namespace Framework\Modules;


class BlogModule
{

    /**
     * @var \Framework\Router\Router
     */
    private $route;
    
    /**
     * @var \Framework\Renderer
     */
    private $renderer;


    /**
     * @param \Framework\Router\Router $route
     */
    public function __construct(\Framework\Router\Router $route , \Framework\Renderer $renderer)
    {
        $route
            ->get('/', [$this , 'home'], 'home')
            ->get('/blog/about', [$this , 'about'], 'about');
        
        $this->route = $route; 
        $this->renderer = $renderer;
    }


    /**
     * @return mixed
     */
    public function home ()
    {
        return $this->renderer->render('blog@home');
    }

    /**
     * @return mixed
     */
    public function about ()
    {
        return $this->renderer->render('blog@about');
    }

}