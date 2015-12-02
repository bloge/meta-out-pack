<?php

require 'vendor/autoload.php';

$app = require 'app.php';

try {
    $route = isset($_GET['route']) ? $_GET['route'] : 'index';
    $route = trim($route, '/');
    
    echo $app->render($route);
}  catch (Bloge\NotFoundException $e) {
    header('HTTP/1.1 404 Not Found');
    
    echo $app->render('404');
}