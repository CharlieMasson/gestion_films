<?php

class UserModel extends Model{

    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = "user";
    }

    /**
     * Creer un utilisateur dans la bdd, hash le mdp 
     *
     * @param User
     * @return void
     */
    public static function create(User $user){
        try{
            $username = $user->getUsername();
            $email = $user->getEmail();
            $password = password_hash($user->getPassword(), PASSWORD_ARGON2I);
            $lastConnexion = $user->getLastConnexion();
            $connexion = Model::getConnection();
            $query = $connexion->prepare("INSERT INTO user (username, email, password, last_connexion) VALUES (:username, :email, :password, :last_connexion)");
            $query->bindParam('username', $username, PDO::PARAM_STR);
            $query->bindParam('email', $email, PDO::PARAM_STR);
            $query->bindParam('password', $password, PDO::PARAM_STR);
            $query->bindParam('last_connexion', $lastConnexion, PDO::PARAM_STR);
            $query->execute();
        } catch(PDOException $e) {
            die('Erreur de requête: ' . $e->getMessage());
        }
    }

    /**
     * Cherche un utilisateur dans la bdd selon son email
     *
     * @param string
     * @return User|null
     */
    public static function searchByEMail(string $email){
        try{
            $connexion = Model::getConnection();
            $query = $connexion->prepare("SELECT * FROM user WHERE email = :email");
            $query->bindParam('email', $email, PDO::PARAM_STR);
            $query->execute();
            $dtbUser = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur de requête: ' . $e->getMessage());
        }
        if (!$dtbUser){
            return null;
        }
        return new User($dtbUser['id'], $dtbUser['username'], $dtbUser['password'], $dtbUser['email'], $dtbUser['last_connexion']);
    }

    /**
     * Cherche un utilisateur dans la bdd selon son pseudonyme
     *
     * @param string
     * @return User|null
     */
    public static function searchByUsername(string $username){
        try{
            $connexion = Model::getConnection();
            $query = $connexion->prepare("SELECT * FROM user WHERE username = :username");
            $query->bindParam(':username', $username);
            $query->execute();
            $dtbUser = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur de requête: ' . $e->getMessage());
        }
        if (!$dtbUser){
            return null;
        }
        return new User($dtbUser['id'], $dtbUser['username'], $dtbUser['password'], $dtbUser['email'], $dtbUser['last_connexion']);
    }

    /**
     * met à jour date de co de l'utilisateur
     *
     * @param string
     * @return void
     */
    public static function updateLastConnexion(string $username){
        try {
            $currentDateTime = date('Y-m-d H:i:s');
            $connexion = Model::getConnection();
            $query = $connexion->prepare("UPDATE user SET last_connexion = :currentDateTime WHERE username = :username");
            $query->bindParam('currentDateTime', $currentDateTime, PDO::PARAM_STR);
            $query->bindParam('username', $username, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
            die('Erreur de requête: ' . $e->getMessage());
        }
    }
}