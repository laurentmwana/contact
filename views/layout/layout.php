

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= SCRIPTS  . 'css' . DIRECTORY_SEPARATOR . 'bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS  . 'fontawesome-free-5.15.3-web' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR .  'all.css' ?>?>">
    
    <title>Boutique | <?= isset($title) ? $title :  'home' ?></title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Tenth navbar example">
        <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><span class="text-info">Boutique</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/about">A propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/post/contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container m-4"><?= $content ?></div>

    
    <script src="<?= SCRIPTS  . 'js' . DIRECTORY_SEPARATOR . 'bootstrap.bundle.min.js' ?>"></script>
    <script src="<?= SCRIPTS  . 'fontawesome-free-5.15.3-web' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'all.js' ?>"></script>
</body>
</html>

<?php

