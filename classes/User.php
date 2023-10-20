<?php

Class User {
    private string $username, $password, $lastConnexion, $email;

    public function __construct(int $id, string $username, string $password, string $email, string $lastConnexion)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->lastConnexion = $lastConnexion;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getLastConnexion() {
        return $this->lastConnexion;
    }

    public function setLastConnexion($lastConnexion) {
        $this->last_connexion = $lastConnexion;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
}