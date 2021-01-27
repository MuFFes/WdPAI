<?php

require_once 'AppController.php';
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../repository/UserRepository.php";
require_once __DIR__ ."/../Authenticator.php";
require_once __DIR__ ."/../ViewSupport.php";

class UsersController extends AppController {

    protected ?string $tabName = "users";

    public function index() {
        $this->add();
    }

    public function getNavigation() {
        if (!Authenticator::checkPermission("user-mgmt"))
            return $this->redirect("login");

        $navigation = array();
        $navigation[] = array("Add user", "/users/add", "fa-user-plus");
        $navigation[] = array("Manage users", "/users/manage", "fa-users-cog");

        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($navigation);
    }

    public function add() {
        if (!Authenticator::checkPermission("user-mgmt"))
            return $this->redirect("login");

        if (self::isGet())
            return $this->render("users/add");

        $userRepository = new UserRepository();
        $login          = $_POST["login"];
        $password       = $_POST["password"];
        $passwordRepeat = $_POST["password-repeat"];

        $viewData = array();
        $viewData["message-class"] = "message--error";

        if ($password != $passwordRepeat) {
            $viewData["register-message"] = "Passwords does not match!";
            return $this->render("/users/add", $viewData);
        }

        if ($userRepository->getUser($login)) {
            $viewData["register-message"] = "User with this login aleady exists!";
            return $this->render("/users/add", $viewData);
        }

        // Truncate to max 56 characters - bcrypt max is 72 -> 16 for pepper, max 56 for password itself
        $password = mb_strimwidth($password, 0, 56);
        $password = password_hash($password.PASSWORD_PEPPER, PASSWORD_DEFAULT);

        $result = $userRepository->addUser($login, $password);
        if (!$result) {
            $viewData["register-message"] = "Error adding user!";
            return $this->render("/users/add", $viewData);
        }

        $viewData["register-message"] = "User added successfully!";
        $viewData["message-class"] = "message--success";
        return $this->render("/users/add", $viewData);
    }
}