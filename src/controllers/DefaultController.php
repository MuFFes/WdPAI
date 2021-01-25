<?php

require_once 'AppController.php';
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../repository/UserRepository.php";

class DefaultController extends AppController {

    public function index() {
        $this->login();
    }

    public function login() {
        if (self::isGet()) {
            return $this->render("login");
        }
        else {
            $userRepository = new UserRepository();
            $login    = $_POST["login"];
            $password = $_POST["password"];
            $user = $userRepository->getUser($login);
            if (!$user) {
                $viewData = array();
                $viewData["login-message"] = "Username or password is not correct!";
                $viewData["message-class"] = "message--error";
                return $this->render("login", $viewData);
            }
            $viewData = array();
            $viewData["login-message"] = "Logged in!";
            $viewData["message-class"] = "message--success";
            return $this->render("login", $viewData);

        }
    }
}