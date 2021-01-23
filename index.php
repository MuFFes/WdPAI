<?php

require __DIR__ .'/src/routing/Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::addRoute('default/login', 'DefaultController', 'login', 'GET');
Router::addRoute('', 'DefaultController', 'login', 'GET');

Router::run($path);
