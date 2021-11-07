<?php

namespace Controller;

class Contact
{
    /**
     * @var \Controller\Post
     */
    private $posts;

    /**
     * @param \Controller\Post $posts
     */
    public function __construct(\Posts\Posts $posts)
    {
        $this->posts = $posts;
    }


    /**
     * @return array
     */
    public function send (): array
    {
        if (isset($_POST['send'])) {
            $v = new \Validator\Validator($_POST);
            $v->labels([
                'required' => [
                    'sujet' => 'Le champs sujet est vide',
                    'name' => 'Le champs nom est vide',
                    'mail' => 'Le champs e-mail est vide',
                    'message' => 'Le champs message est vide',
                ],

                'strlen' => [
                    'sujet' => 'Le champs sujet doit avoir au moins 3 caratère',
                    'name' => 'Le champs nom doit avoir au moins 3 caratèree',
                    'mail' => 'Le champs e-mail doit avoir au moins 3 caratèree',
                    'message' => 'Le champs message doit avoir au moins 3 caratèree',
                ],
                'regex' => [
                    'name' => 'Le champs nom n\'est pas valide',
                    'sujet' => 'Le champs sujet n\'est pas valide',
                ]
            ]);

            $v->rule('regex' , 'name' , '(^[a-zA-Z-_]+$)');
            $v->rule('email' , 'mail');
            $v->rule('regex' , 'sujet' , '(^[a-zA-Z-0-9_]+$)');

            $v->rule('strlen' , 'sujet', 255, 3);
            $v->rule('strlen' , 'name' , 255, 3);
            $v->rule('strlen' , 'mail' , 255, 3);
            $v->rule('strlen' , 'message' , 255, 3);
            
            $v->rule('required' , 'sujet');
            $v->rule('required' , 'name');
            $v->rule('required' , 'mail');
            $v->rule('required' , 'message');

            if ($v->validate()) {
                
            }

            return $v->getErrors();
        }

        return [];
    }
}