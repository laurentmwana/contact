<?php

namespace Framework\interfaces;

/**
 * interface pour la classe Post 
 */
interface InterfacePost 
{

    /**
     * @return string
     */
    public function getName (): string;

    /**
     * @param string $name
     * 
     * @return void
     */
    public function setName (string $name): void;

    
    /**
     * @return string
     */
    public function getMail (): string;

    /**
     * @param string $mail
     * 
     * @return void
     */
    public function setMail (string $mail): void;

    
    /**
     * @return string
     */
    public function getMessage (): string;

    /**
     * @param string $message
     * 
     * @return void
     */
    public function setMessage (string $message): void;

    
    /**
     * @return string
     */
    public function getSujet (): string;

    /**
     * @param string $sujet
     * 
     * @return void
     */
    public function setSujet (string $sujet): void;

     /**
     * @return string
     */
    public function getQuestion (): string;

    /**
     * @param string $question
     * 
     * @return void
     */
    public function setQuestion (string $question): void;

    
}