<?php

namespace Framework\interfaces;


/**
 * interface pour la classe captcha 
 */
interface interfaceCaptcha {

    /**
     * @param string $action
     * @param string $key
     * @param null $cond1
     * @param null $cond2
     * 
     * @return self
     */
    public function rule(string $action, string $key, $cond1 = null, $cond2 = null): self;

    /**
     * @return array
     */
    public function getErrors(): array;

    /**
     * @return bool
     */
    public function validate(): bool;

    /**
     * @param array $messages
     * 
     * @return void
     */
    public function labels(array $messages): void;

    
}