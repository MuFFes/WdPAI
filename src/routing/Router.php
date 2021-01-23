<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/routing/Route.php';


class Router {

    public static array $routes;

    public static function addRoute($url, $controller, $action = "index", $method = "GET") {
        self::$routes[] = new Route($url, $controller, $action, $method);
    }

    public static function run($url) {
        foreach (self::$routes as $route) {
            if ($route->getUrl() == $url && $route->getMethod() == $_SERVER['REQUEST_METHOD']) {
                $controller = $route->getController();
                $action = $route->getAction();

                return $controller->$action();
            }
        }
        return (new DefaultController())->login();
    }

    public static function init($routeCollection) {
        self::$routes = $routeCollection;
    }
}