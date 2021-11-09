<?php

namespace Controller;

use  Framework\interfaces\interfaceCache;

/**
 * [Description Cache]
 */
class Cache implements interfaceCache
{

    private static $path;

    /**
     * @var array
     */
    private $questions = [];


    public function __construct(string $path)
    {
        self::$path = $path .  DIRECTORY_SEPARATOR . date('Y-m-d');
        $this->questions = [
            'question-1' => [
                'quiz' => "Que vaut 4 + 4 = ?",
                'response' => '8'
            ],

            'question-2' => [
                'quiz' => "Quel est la capital de la RDC ?",
                'response' => 'kinshasa'
            ],

            'question-3' => [
                'quiz' => "Quel est la capital de France ?",
                'response' => 'paris'
            ],

            'question-4' => [
                'quiz' => "Completez les ... par le chiffre qui convient :  1  2  3  4  5 ... 7",
                'response' => '6'
            ]
        ];        
    }

    /**
     * 
     * @return string
     */
    public static function get (): string
    {
        $file = file_get_contents(self::$path);
        return explode(':', $file)[1];
    }
    
    /**
     * @param mixed $key
     * @param mixed $value
     * @param mixed $expirate
     * 
     * @return void
     */
    public function set (): void
    {
        $index = $this->index($this->questions);
        $value = $this->response($index);
        file_put_contents(self::$path , $index . ':' . $value);
    }


    /**
     * @param array $array
     * 
     * @return int
     */
    private function index (array $array): string
    {
        return array_rand($array);
    }

    /**
     * @param mixed $key
     * 
     * @return bool
     */
    public function has ($key): bool
    {
        $value = $this->questions[$key];
        if (isset($value) && (is_array($value) && !empty($value))) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @return bool
     */
    public function delete(): bool
    {
        return unlink(self::$path);
    }


    /**
     * @return array
     */
    public function question ($key): string
    {
        return $this->questions[$key]['quiz'];
    }

    /**
     * @param mixed $key
     * 
     * @return string
     */
    public function response($key): string
    {
        return $this->questions[$key]['response'];
    }


    /**
     * @return array
     */
    public function explodes (): array
    {
        $value = $this->getValue();
        return explode(':', $value);
    }

    private function getValue (): string
    {
        return file_get_contents(self::$path);
    }



}