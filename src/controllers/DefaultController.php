<?php

require_once 'AppController.php';
require_once __DIR__."/../models/User.php";

class DefaultController extends AppController {

    public function index() {
        $this->login();
    }

    public function login() {
        if (self::isGet()) {
            return $this->render("login");
        }
        else {
            $email    = htmlentities($_POST["email"]);
            $password = htmlentities($_POST["password"]);
            $user = new User($email, $password);
            $viewData = array();
            $viewData["login-message"] = "Username or password is not correct!";
            $viewData["message-class"] = "message--error";

//            if ($user !== "test" || $password !== "test"){
//
//                return $this->render("login", $viewData);
//            }
            return $this->render("login", $viewData);

        }
    }
}