<?php

namespace Framework\Exceptions;

/**
 * Declanche une exception dans le validator 
 */
class ValidatorException extends \Exception
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
}