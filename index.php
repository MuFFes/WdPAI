<?php

require __DIR__ . '/src/Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::addController("DefaultController", "");
Router::addController("ProjectController", "project");

Router::run($path);
