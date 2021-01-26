<?php

require_once 'AppController.php';
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../repository/UserRepository.php";
require_once __DIR__ . "/../Authenticator.php";

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
            // Truncate to max 56 characters - bcrypt max is 72 -> 16 for pepper, max 56 for password itself
            $password = mb_strimwidth($password, 0, 56);

            // TODO: Creating password:
            // $password = password_hash($_POST["password"].PASSWORD_PEPPER, PASSWORD_DEFAULT);

            $user = $userRepository->getUser($login);
            if (!$user || !password_verify($password.PASSWORD_PEPPER, $user->getPassword())) {
                $viewData = array();
                $viewData["login-message"] = "Username or password is not correct!";
                $viewData["message-class"] = "message--error";
                return $this->render("login", $viewData);
            }
            $_SESSION["userId"] = $user->getId();
            Authenticator::updatePermissions();

            return $this->redirect("project/");
        }
    }
}