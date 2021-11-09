<?php

namespace Controller;

/**
 * Tritement des informations saisie par l'utilisateur
 */
class Contact
{
    /**
     * Les données envoyées par l'user
     * @var \Posts\Posts
     */
    private $posts;

    /**
     * Conctact Constructor
     * @param \Posts\Posts $posts
     */
    public function __construct(\Posts\Posts $posts)
    {
        $this->posts = $posts;
    }


    /**
     * Envoie et vérificatication de données 
     * @return array
     */
    public function send (): array
    {
        if (isset($_POST['send'])) {

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
            
            // les erreurs
            $v = new \Validator\Validator($_POST);
            $v->labels([
                'required' => [
                    'sujet' => 'Le champs sujet est vide',
                    'name' => 'Le champs nom est vide',
                    'mail' => 'Le champs e-mail est vide',
                    'message' => 'Le champs message est vide',
                    'question' => 'Vous devrez répondre à la question',
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

            // limitation de valeur à saisir
            $v->rule('regex' , 'name' , '(^[a-zA-Z-_]+$)');
            $v->rule('email' , 'mail');
            $v->rule('regex' , 'sujet' , '(^[a-zA-Z-0-9_]+$)');

            // nombres de caratère
            $v->rule('strlen' , 'sujet', 255, 3);
            $v->rule('strlen' , 'name' , 255, 3);
            $v->rule('strlen' , 'mail' , 255, 3);
            $v->rule('strlen' , 'message' , 255, 3);
            
            // champs vide
            $v->rule('required' , 'sujet');
            $v->rule('required' , 'name');
            $v->rule('required' , 'mail');
            $v->rule('required' , 'message');
            

            $c = new \Controller\Cache(dirname(__DIR__) . DIRECTORY_SEPARATOR . "cache");
            $key = $c->explodes()[0];
            $response = $c->response($key);

            $v->rule('bool', 'question', $this->posts->getQuestion(), $response);
            $v->rule('required' , 'question');
            
            if ($v->validate()) {
                $my = "laurentmwn@contact.com";
                $mail = mail($my, $this->posts->getSujet(),"email : "  . $this->posts->getMail() . PHP_EOL . $this->posts->getMessage());
                if ($mail === true) {
                    $c->delete();
                }

                \Flash\SessionMessage::getSession()->write("success", "Votre demande a été envoyer avec succès");
                \Controller\Helpers::header("/post/contact");
            }

            return $v->getErrors();

        }

        return [];
    }
}