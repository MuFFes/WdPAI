<?php

require_once 'AppController.php';
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../repository/UserRepository.php";
require_once __DIR__ . "/../Authenticator.php";

class ProjectController extends AppController {

    protected ?string $tabName = "project";

    public function index() {
        $this->project();
    }

    public function project() {
        if (count(Authenticator::getUserProjects()) == 0)
            return $this->redirect("users/");

        return $this->render("project");
    }
}