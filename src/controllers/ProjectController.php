<?php

require_once 'AppController.php';
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../repository/UserRepository.php";
require_once __DIR__ . "/../Authenticator.php";

class ProjectController extends AppController {

    public function index() {
        $this->project();
    }

    public function project() {
        if (!Authenticator::checkPermission("project-mgmt")) {
            return $this->redirect("login");
        }
        return $this->render("project");
    }

}