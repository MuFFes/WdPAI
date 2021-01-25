<?php

require_once "Repository.php";
require_once __DIR__."/../models/User.php";

class UserRepository extends Repository {
    public function getUser(string $login) {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public."User" WHERE login = :login;
        ');
        $statement->bindParam(":login", $login, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchObject(User::class);
    }
}