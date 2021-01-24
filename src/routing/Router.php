<?php

require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/DefaultController.php';


class Router {

    public static array $controllerMappings;

    public static function addController($controllerName, $mapping) {
        self::$controllerMappings[$mapping] = new $controllerName();
    }

    public static function run($url) {
        $urlSegments = explode("/", $url);
        $action = array_pop($urlSegments);
        $mapping = implode("/", $urlSegments);

        // Treat first url segment as controller/index if controller of this name exists
        if ($mapping == "" and array_key_exists($action, self::$controllerMappings)){
            $mapping = $action;
            $action = "";
        }

        try {
            if (array_key_exists($mapping, self::$controllerMappings)) {
                $controller = self::$controllerMappings[$mapping];

                if(method_exists($controller, $action)){
                    return $controller->$action();
                }
                return $controller->index();
            }
        } catch (Exception $e) {
            return (new DefaultController())->index();
        }
        return (new DefaultController())->index();
    }
}
