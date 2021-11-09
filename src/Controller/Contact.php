<?php

namespace Controller;

class Contact
{
    /**
     * @var \Posts\Posts
     */
    private $posts;

    /**
     * @param \Posts\Posts $posts
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

                $c = new \Controller\Cache(dirname(__DIR__) . DIRECTORY_SEPARATOR . "cache");
                $key = $c->explodes()[0];
                $response = $c->response($key);

                try {
                    $this->posts->setQuestion($_POST['question']);
                    $this->posts->setName($_POST['name']);
                    $this->posts->setSujet($_POST['sujet']);
                    $this->posts->setMail($_POST['mail']);
                    $this->posts->setMessage($_POST['message']);
                }catch (\TypeError $th) {
                    \Flash\SessionMessage::getSession()->write("warning", "La clé du formulaire ne peut pas etre modifier ou supprimer");
                    \Controller\Helpers::header("/post/contact");

                } 
                

                if ($response ===  $this->posts->getQuestion()) {
                    
                    $my = "laurentmwn@contact.com";
                    $mail = mail($my, $this->posts->getSujet(),"email : "  . $this->posts->getMail() . PHP_EOL . $this->posts->getMessage());
                    if ($mail === true) {
                        $c->delete();
                    }
                } else {
                    $v->rule('write','question' , "{$this->posts->getQuestion()} n'est pas la bonne réponse");
                    return $v->getErrors();
                }
            }

            return $v->getErrors();

        }

        return [];
    }
}