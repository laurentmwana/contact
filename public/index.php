<?php

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

define("NAMESPACES", dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define("SCRIPTS", dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR);

// initialisation du renderer pour charge les fichiers
$renderer = new \Framework\Renderer(NAMESPACES);

// initialisation de l'app
$app = new \Framework\App([
    \Framework\Modules\BlogModule::class,
    \Framework\Modules\PostsModule::class
],
[
  'renderer' => $renderer  
]);

// démarrage de l'app
$app->start($_GET['url']);