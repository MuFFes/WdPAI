<?php

require_once 'AppController.php';
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../repository/UserRepository.php";
require_once __DIR__ ."/../Authenticator.php";
require_once __DIR__ ."/../ViewSupport.php";

class DefaultController extends AppController {

    public function index() {
        $this->login();
    }

    public function login() {
        if (Authenticator::isLoggedIn())
            return $this->redirect("project/");

        if (self::isGet())
            return $this->render("login");

        $userRepository = new UserRepository();
        $login    = $_POST["login"];
        $password = $_POST["password"];
        // Truncate to max 56 characters - bcrypt max is 72 -> 16 for pepper, max 56 for password itself
        $password = mb_strimwidth($password, 0, 56);

        $viewData = array();
        $viewData["message-class"] = "message--error";

        $user = $userRepository->getUser($login);
        if (!$user || !password_verify($password.PASSWORD_PEPPER, $user->getPassword())) {
            $viewData["login-message"] = "Username or password is not correct!";
            return $this->render("login", $viewData);
        }
        $_SESSION["userId"] = $user->getId();
        Authenticator::updatePermissions();

        if (count(Authenticator::getUserProjects()) == 0 && count($_SESSION["globalPermissions"])){
            $viewData = array();
            $viewData["login-message"] = "Not enough permissions!";
            return $this->render("login", $viewData);
        }

        return $this->redirect("project/");
    }

    public function logout() {
        Authenticator::clearSession();
        $viewData = array();
        $viewData["login-message"] = "Logged out successfully!";
        $viewData["message-class"] = "message--success";
        return $this->render("login", $viewData);
    }
}