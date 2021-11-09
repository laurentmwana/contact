<?php

use HTML\Forms;
$forms = new Forms($_POST, $posts);
$session = \Flash\SessionMessage::getSession();
$message = new \Flash\AlertSession($session->isMessage());

$c = new \Controller\Cache(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'src' .  DIRECTORY_SEPARATOR . "cache");
$c->set();
$key = $c->explodes()[0];
$question = $c->question($key); 

?>


<h2 class="text-muted">Contact</h2>

<div class="container mb-4 mt-4"> 
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-secondary">Les informations : </h4>
                </div>
                <div class="card-body">
                   <p>Nom : <em>Mwanamputu</em></p>
                   <p>Postnom : <em>Labeya</em></p>
                   <p>Prénom : <em>Laurent</em></p>
                   <p>E-mail : <em>Laurentmwn@gmail.com</em></p>
                   <em> <address>Avenue bobozo n° 33 , Quartier sans-fil , Commune de Masina</address></em>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6">
            <?= $message->message() ?>
            <div class="card">
                <div class="card-header">
                   <h4 class="text-muted text-center">Formulaire de contact</h4>  
                </div>
                <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                    <?= $forms->label('sujet', "La raison de votre message :")?>
                    <?= $forms->form('input:text', 'sujet', '' , 'col-md-6') ?>

                    <?= $forms->label('name', "Entrez votre nom : ")?>
                    <?= $forms->form('input:text', 'name', '' , 'col-md-6') ?>
                    </div>
                   

                    <?= $forms->label('mail', "Entrez votre email ")?>
                    <?= $forms->form('input:email', 'mail') ?>

                    <?= $forms->label('message', "Saississez votre message ")?>
                    <?= $forms->form('textarea', 'message') ?>

                    <?= $forms->label('question',  "<mark> Répondez à la question </mark>  : <em> $question </em>")?>
                    <?= $forms->form('input:text', 'question', '', 'col-md-8') ?>

                    <?= $forms->button('send') ?>
            </form>
                </div>
            </div>
           

            
        </div>
    </div>
</div>