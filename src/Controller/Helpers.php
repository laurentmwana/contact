<?php

namespace Controller;

class Helpers 
{


    /**
     * @param string $path
     * @param int $code
     * 
     * @return void
     */
    public static function header (string $path , int $code =  301): void
    {
        header("Location: {$path}", true , $code);
        exit();
    }
}