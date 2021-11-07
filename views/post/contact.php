<?php

use HTML\Forms;
$forms = new Forms($_POST, $posts);
$session = \Flash\SessionMessage::getSession();
$flash = new \Flash\AlertSession($session->isMessage());
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
            <?= $flash->message() ?>
            <div class="card">
                <div class="card-header">
                   <h4 class="text-muted text-center">Formulaire de contact</h4>  
                </div>
                <div class="card-body">
                <form action="" method="POST">
                    <?= $forms->label('sujet', "Pourquoi souhaitez-vous nous contacter ?")?>
                    <?= $forms->form('input:text', 'sujet') ?>

                    <?= $forms->label('name', "Entrez votre nom : ")?>
                    <?= $forms->form('input:text', 'name') ?>

                    <?= $forms->label('mail', "Entrez votre email ")?>
                    <?= $forms->form('input:email', 'mail') ?>

                    <?= $forms->label('message', "Saississez votre message ")?>
                    <?= $forms->form('textarea', 'message') ?>
                    <?= $forms->button('send') ?>
            </form>
                </div>
            </div>
           

            
        </div>
    </div>
</div>