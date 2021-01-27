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
        $navigation = array();
        $navigation["Add user"] = "/users/add";
        $navigation["Manage users"] = "/users/manage";

        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($navigation);
    }

    public function add() {
        if (!Authenticator::checkPermission("user-mgmt"))
            return $this->redirect("project");

        if (self::isGet())
            return $this->render("users");


        $login    = $_POST["login"];
        $password = $_POST["password"];
        // Truncate to max 56 characters - bcrypt max is 72 -> 16 for pepper, max 56 for password itself
        $password = mb_strimwidth($password, 0, 56);
        $password = password_hash($password.PASSWORD_PEPPER, PASSWORD_DEFAULT);
    }


}