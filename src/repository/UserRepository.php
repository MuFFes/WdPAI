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

    public function addUser(string $login, string $password): bool {
        $statement = $this->database->connect()->prepare('
            INSERT INTO public."User" ("login", "password") VALUES(:login, :password);
        ');
        $statement->bindParam(":login", $login, PDO::PARAM_STR);
        $statement->bindParam(":password", $password, PDO::PARAM_STR);

        return $statement->execute();
    }
}