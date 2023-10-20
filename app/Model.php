<?php
abstract class Model{
    // Informations de la base de données
    private static $host = "";
    private static $db_name = "";
    private static $username = "";
    private static $password = "";

    /**
     * Fonction d'initialisation de la base de données
     *
     * @return PDO
     */
    public static function getConnection(){
        // On supprime la connexion précédente
        $connexion = null;
        // On essaie de se connecter à la base
        try{
            $connexion = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
            $connexion->exec("set names utf8");
            return $connexion;
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }   
}
