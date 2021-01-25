<?php


class User {
    private $id;
    private $login;
    private $password;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function setLogin(string $login): void {
        $this->login = $login;
    }


}