<?php

namespace Validator;

use Framework\Exceptions\ValidatorException;
use Framework\interfaces\interfaceValidator;

/**
 * Validation des informations poster par l'utilisateur 
 */
class Validator  implements interfaceValidator
{
    /**
     * @var array
     */
    private $label = [];

    /**
     * Les données envoyer par l'utilisateur 
     * @var array
     */
    private $posts = [];

    /**
     * Enregistrer tous les erreurs 
     * @var array
     */
    private $errors = [];

    /**
     * @param array $posts
     */
    public function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @param string $action
     * @param string $key
     * @param null $cond1
     * @param null $cond2
     * 
     * @return self
     */
    public function rule(string $action, string $key, $cond1 = null, $cond2 = null): self
    {
        if ($action === 'required') {
            $this->required($key);
        } elseif ($action === 'dates' && (is_null($cond1) && is_null($cond2))) {
            $this->dates($key);
        } elseif ($action === 'email' && (is_null($cond1) && is_null($cond2))) {
            $this->email($key);
        } elseif ($action === 'trim' && (is_null($cond1) && is_null($cond2))) {
            $this->trim($key);
        } elseif ($action === 'strlen' && (!is_null($cond1) && !is_null($cond2))) {
            $this->strlen($key , $cond1 ,$cond2);
        } elseif ($action === 'regex' && (!is_null($cond1) && is_null($cond2))) {
            $this->regex($key , $cond1);
        } elseif ($action === 'bools' && (!is_null($cond1) && !is_null($cond2))) {
            $this->bools($key , $cond1, $cond2);
        } elseif ($action === 'write' && (!is_null($cond1) && is_null($cond2))) {
            $this->write($key , $cond1);
        }


        return $this;
    }


    /**
     * @param mixed $motif
     * @param mixed $messages
     * 
     * @return void
     */
    public function set($motif, $messages): void
    {
        $this->errors[$motif] = $messages;
    }

    /**
     * Vérifie que le champs n'est pas valide est requiet (important , obligatoire)
     * @param mixed $key
     * 
     * @return void
     */
    private function required ($key): void
    {
        if (empty($this->fields($key))) {
           
            if (isset($this->label['required'][$key]) && !empty($this->label['required'][$key])) {
                $value = $this->label['required'][$key];
            } else {
                $value = "{$key} est requiet";
            }
            $this->errors[$key] = $value;
        }
    }

    /**
     * Vérifie que la date est en format Y-m-d H:i:s
     * @param mixed $key
     * 
     * @return void
     */
    private function dates ($key) : void
    {
        $date = date_parse($this->fields($key))['errors'];
        if (!empty($date)) {
            if (isset($this->label['dates'][$key]) && !empty($this->label['dates'][$key])) {
                $value = $this->label['dates'][$key];
            } else {
                $value = "{$key} n'est pas une date";
            }
            $this->errors[$key] = $value;
        }  
    }

    /**
     * @param string $key
     * @param string $one
     * @param string $two
     * 
     * @return void
     */
    private function bools (string $key , string $one ,string  $two): void
    {
        if ($one != $two) {
            if (isset($this->label['bools'][$key]) && !empty($this->label['bools'][$key])) {
                $value = $this->label['bools'][$key];
            } else {
                $value = "{$key} invalide";
            }
            $this->errors[$key] = $value;
        }
    }

  
    /**
     * @param mixed $key
     * @param null $value
     * 
     * @return void
     */
    private function write ($key , $value = null): void
    {
        if (is_null($value)) {
            $values = "Reponse incorrecte";
        } else {
            $values = $value;
        }
        $this->errors[$key] = $values;
    }

    /**
     * Vérifie que l'email est bonne en format (exemple@email.fr)
     * @param mixed $key
     * 
     * @return void
     */
    private function email ($key) : void
    {
        try {
            $value = $this->fields($key);
            if (!filter_var($value , FILTER_VALIDATE_EMAIL)) {
                
                if (isset($this->label['email'][$key]) && !empty($this->label['email'][$key])) {
                    $value = $this->label['email'][$key];
                } else {
                    $value = "{$key} n'est pas un e-mail";
                }
    
                $this->errors[$key] = $value;
            }
        } catch (\Throwable $th) {
            \Flash\SessionMessage::getSession()->write("danger", "Vous ne pouvez pas modifier le  nom du champs {$key} ");
            \Controller\Helpers::header("/post/contact");
        }
       
    }

    /**
     * Les nombres min de caratère en max de caratère 
     * @param mixed $key
     * @param mixed $max
     * @param mixed $min
     * 
     * @return void
     */
    private function strlen ($key , $max , $min): void
    {
        try {
            $value = mb_strlen($this->fields($key));
            if ($value < $min || $value > $max) {
            
                if (isset($this->label['strlen'][$key]) && !empty($this->label['strlen'][$key])) {
                    $value = $this->label['strlen'][$key];
                } else {
                    $value = "{$key} doit avoir au moins {$min} caratère ";
                }

                $this->errors[$key] = $value;
            }  
        } catch (\Throwable $th) {
            \Flash\SessionMessage::getSession()->write("danger", "Vous ne pouvez pas modifier le  nom du champs {$key} ");
            \Controller\Helpers::header("/post/contact");
        }
        
    }

    /**
     * Les expressions regulier
     * @param string $key
     * @param string $pattern
     * 
     * @return void
     */
    private function regex (string $key , ?string $pattern = null): void
    {
        try {
            $value = $this->fields($key);
            if (!preg_match($pattern , $value) && !is_null($pattern)) {
                if (isset($this->label['regex'][$key]) && !empty($this->label['regex'][$key])) {
                    $value = $this->label['regex'][$key];
                } else {
                    $value = "{$key} n'est pas valide";
                }

                $this->errors[$key] = $value;
            }
        } catch (\Throwable $th) {
            \Flash\SessionMessage::getSession()->write("danger", "Vous ne pouvez pas modifier le  nom du champs {$key} ");
            \Controller\Helpers::header("/post/contact");

        }


        
    }

    /**
     * Efface les espaces de noms 
     * @param mixed $key
     * 
     * @return void
     */
    private function trim ($key): void
    {
        $value = trim($this->fields($key));
        $this->posts[$key] = $value;
    }

    /**
     * Vérifie que la clé existe dans le tableau de données 
     * @param mixed $key
     * 
     * @return string|null
     */
    private function fields ($key): ?string
    {
        if (!empty($this->posts)) {
            if (isset($this->posts[$key])) {
                return $this->posts[$key];
            }

            throw new ValidatorException("La clé {$key} n'est pas définie");
        }

        return null;
    }


    /**
     * Le tableau d'erreurs 
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Vérifie qu"il y a pas d'erreurs 
     * @return bool
     */
    public function validate(): bool
    {
        return empty($this->errors);
    }

    /**
     * Définie les messages d'erreurs
     * @param array $messages
     * 
     * @return void
     */
    public function labels(array $messages): void
    {
        foreach ($messages as $action => $message) {
            foreach ($message as $key => $value) {
                $this->label[$action][$key] = $value;
            }
        }
    }
}