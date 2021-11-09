<?php

namespace  Framework\interfaces;

interface interfaceCache
{
    /**
     * 
     * @return string
     */
    public function get (): string;



    /**
     * 
     * @return void
     */
    public function set (): void;

    /**
     * @param mixed $key
     * 
     * @return bool
     */
    public function has ($key): bool;

    /**
     * 
     * @return bool
     */
    public function delete (): bool;

    
    /**
     * @param mixed $key
     * 
     * @return string
     */
    public function response ($key): string;


    
    /**
     * @param mixed $key
     * 
     * @return array
     */
    public function question ($key): string;
    
}