<?php

require __DIR__ . '/../vendor/autoload.php';
$app = new Slim\App;

require '../src/routes/makanan.php';


$app->run();

?>