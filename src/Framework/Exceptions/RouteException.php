<?php

namespace Framework\Exceptions;

/**
 * Declanche une exception de la route 
 */
class RouteException extends \Exception
{
    
    /**
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = "" , int $code = 0 ,\Throwable $previous = null)
    {
        parent::__construct($message , $code , $previous);
    }

    public function notfound ($message): void
    {
        http_response_code(404);
        $render = new \Framework\Renderer(NAMESPACES);
        $render->render("errors@404", "Errors", compact('message'));
    }
}