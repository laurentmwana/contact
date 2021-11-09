<?php

namespace HTML;

class Forms 
{

    /**
     * Etiquetter les champs 
     * @var array
     */
    private $label = [];

    /**
     * Les erreurs envoyer par le controller 
     * @var array
     */
    private $errors = [];

    /**
     * Les informations posteés
     * @var array
     */
    private $posts = [];

    /**
     * @param array $errors
     */
    /**
     * @param array $posts
     * @param array $errors
     */
    public function __construct($posts = [] , array $errors = [])
    {
        $this->errors = $errors;
        $this->posts = $posts;

    }


    /**
     * @param string $form
     * @param string $key
     * @param null $value
     * @param string $cols
     * @param string $generate
     * 
     * @return mixed
     */
    public function form (string $form , string $key , $value = '' , $cols = 'col-md-12' , string $generate = '')
    {
        if (strstr($form , 'input:')) {
            $type  = explode(':' , $form)[1];
            return $this->input($key , $value , $type , $cols);
        } elseif ($form === 'textarea') {
            return $this->textarea($key , $value , $cols);
        }
        
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @param string $type
     * @param mixed $cols
     * 
     * @return string
     */
    private function input($key , $value = '' , $type = 'text' ,  $cols = "col-md-12"): string
    {
        $label = isset($this->label[$key])  ? $this->label[$key] : $key;
        [$class , $feedback, $values] = $this->feedback($key , $value);
        return <<<HTML
        <div class="form-group mb-3 {$cols}">
            <label for="{$key}"  class="form-label">{$label}</label>
            <input type="{$type}" name="{$key}" id="{$key}" class="{$class}" value="{$values}">
            {$feedback}
        </div>
HTML;
    }


    /**
     * @param mixed $key
     * @param mixed $value
     * @param mixed $cols
     * 
     * @return string
     */
    public function textarea ($key , $value , $cols): string
    {
        $label = isset($this->label[$key])  ? $this->label[$key] : $key;
        [$class , $feedback , $values] = $this->feedback($key , $value);
        return <<< HTML
        <div class="form-group mb-3 {$cols}">
            <label for="{$key}"  class="form-label">{$label}</label>
            <textarea name="{$key}" id="{$key}"  class="{$class}">{$values}</textarea>
            {$feedback}
        </div>
HTML;
    }

    /**
     * @param string $name
     * @param  string
     * @param string $text
     * @param mixed string
     * 
     * @return string
     */
    public function button (string $name , string $type ="submit" ,  string $text = "Envoyer" , string $class = "btn btn-primary"): string
    {
        return <<<HTML
        <button type='{$type}' name='{$name}' class='{$class} mb-3'>{$text}</button>
HTML;
    }


    /**
     * @param string $key
     * @param string $label
     * 
     * @return void
     */
    public function label (string $key , string $label): void
    {
        $this->label[$key] = $label;
    }

    /**
     * @param mixed $key
     * 
     * @return mixed
     */
    private function getValue ($key)
    {
        if (isset($this->posts[$key])) {
            return $this->posts[$key];
        }

        return null;
    }


    /**
     * @param mixed $key
     * @param mixed $value
     * 
     * @return array
     */
    private function feedback ($key , $value): array
    {
        $values = $this->getValue($key);
        if ((!empty($value) && empty($this->posts))) {
            $values = $value;
        }

        $class = 'form-control';
        $feedback = "";
        if (!empty($this->errors[$key])) {
            $error = $this->errors[$key];
            $errors = implode('<br>' , [$error]);
            $class .= ' is-invalid';
            $feedback .= "<div class='invalid-feedback'><em>{$errors} </em></div>";
        } else {
            if (!isset($this->errors[$key]) && !empty($this->getValue($key))) {
                $valid = "champs valide";
                $errors = implode('<br>' , [$valid]);
                $class .= ' is-valid';
                $feedback .= "<div class='valid-feedback'><em>{$errors} </em></div>";
            }
        }
        
        return [$class , $feedback , $values];
    }


}