<?php

namespace Framework\Modules;

use Controller\Forms\contactForm;

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
     * @var \Controller\Contact
     */
    private $contact;

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
        $this->contact = new \Controller\Contact(new \Posts\Posts);
    }

    /**
     * @return mixed
     */
    public function contact ()
    {
        $posts = $this->contact->send();
        return $this->renderer->render('post@contact', "layout" , compact('posts'));
    }
}