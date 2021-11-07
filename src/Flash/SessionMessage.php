<?php

namespace Flash;


class SessionMessage 
{
    /**
     * @var string 
     */
    private $keys;


    /**
     * @var \Messages\SessionMessage
     */
    private static $getsession;

    
    /**
     * @var array
     */
    private $session = [];

    /**
     * @param string $keys
     * 
     * @return SessionMessage
     */
    public static function getSession(string $keys = 'flash'): SessionMessage
    {
        if (is_null(self::$getsession)) {
            self::$getsession = new SessionMessage($keys);
        }

        return self::$getsession;
    }


    /**
     * SessionMessage Constructor 
     * @param string $keys
     */
    public function __construct(string $keys = 'flash')
    {
        $this->keys = $keys;

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Ecrire dans la session (message)
     * @param string $key
     * @param string $message
     * 
     * @return void
     */
    public function write (string $key , string $message): void
    {
        $_SESSION[$this->keys][$key] = $message;
    }


    /**
     * Vérifie que la clé définit existe 
     * @return bool
     */
    public function has (): bool
    {
        if (isset($_SESSION[$this->keys]) && !empty($_SESSION[$this->keys])) {
            return true;
        }

        return false;
    }


    /**
     * Retourne un tableau de message 
     * @return array string[]
     */
    public function isMessage (): array
    {
        if ($this->has()) {
            $this->session = $_SESSION[$this->keys];
            unset($_SESSION[$this->keys]);
        }

        return $this->session;
        
    }
}