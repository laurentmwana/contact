<?php

namespace Framework\Modules;


class PostsModule
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
     * @param \Framework\Renderer $renderer
     */
    public function __construct(\Framework\Router\Router $route , \Framework\Renderer $renderer)
    {
        $route->get('/post/contact', [$this , 'contact'], 'contact');
        $route->post('/post/contact', [$this , 'contact'], 'contact');
        
        $this->route = $route; 
        $this->renderer = $renderer;
    }

    /**
     * @return mixed
     */
    public function contact ()
    {
        return $this->renderer->render('post@contact');
    }
}