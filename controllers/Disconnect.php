<?php
require_once(ROOT.'app/SessionManager.php');

class Disconnect extends Controller{
    /**
     * Cette méthode permet a un utilisateur de se deconnecter
     *
     * @return void
     */
    public function index(){
        SessionManager::deleteSession();
        header("Location: ./Login");

    }
}
