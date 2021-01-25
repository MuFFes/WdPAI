<?php

require __DIR__ .'/src/routing/Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::addController("DefaultController", "");
Router::addController("SecurityController", "security");

Router::run($path);
