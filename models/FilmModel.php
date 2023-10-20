<?php

class FilmModel extends Model{

    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = "film";
    }

    /**
     * Méthode permettant d'afficher un film à partir de son slug
     *
     * @param string
     * @return void
     */
    public function findBySlug(string $slug){
        try{
            $connexion = Model::getConnection();
            $query = $connexion->prepare("SELECT * FROM Film WHERE `slug`= :slug");
            $query->bindParam(':slug', $slug);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);    
        } catch(PDOException $e) {
            die('Erreur de requête: ' . $e->getMessage());
        }
    }

    /**
     * Insert une donnée dans la table film
     *
     * @param Film
     * @return void
     */
    public static function create(Film $film){
        try{
            $connexion = Model::getConnection();
            $query = $connexion->prepare("INSERT INTO Film (name, id_user, director, synopsys, type, scriptwriter, production_company, release_year, slug) VALUES (:name, :id_user, :director, :synopsys, :type, :scriptwriter, :production_company, :release_year, :slug)");
            $name = $film->getName();
            $idUser = $film->getIdUser();
            $director = $film->getDirector();
            $synopsis = $film->getSynopsis();
            $type = $film->getType();
            $scriptwriter = $film->getScriptWriter();
            $releaseYear =  $film->getReleaseYear();
            $slug = $film->getSlug();
            $productionCompany = $film->getProductionCompany();
            $query->bindParam(':name', $name);
            $query->bindParam(':id_user', $idUser);
            $query->bindParam(':director', $director);
            $query->bindParam(':synopsys', $synopsis);
            $query->bindParam(':type', $type);
            $query->bindParam(':scriptwriter', $scriptwriter);
            $query->bindParam(':production_company', $productionCompany);
            $query->bindParam(':release_year', $releaseYear);
            $query->bindParam(':slug', $slug);
            $query->execute();
        } catch(PDOException $e) {
            die('Erreur de requête: ' . $e->getMessage());
        }
    }

    /**
     * Modifie une donnée dans la table film
     *
     * @param Film
     * @return void
     */
    public static function modify(Film $film){
        try{
            $connexion = Model::getConnection();
            $query = $connexion->prepare("UPDATE Film 
                SET name = :name, 
                    id_user = :id_user, 
                    director = :director, 
                    synopsys = :synopsys, 
                    type = :type, 
                    scriptwriter = :scriptwriter, 
                    production_company = :production_company, 
                    release_year = :release_year, 
                    slug = :slug 
                WHERE id = :id");
            $id = $film->getId();
            $name = $film->getName();
            $idUser = $film->getIdUser();
            $director = $film->getDirector();
            $synopsis = $film->getSynopsis();
            $type = $film->getType();
            $scriptwriter = $film->getScriptWriter();
            $releaseYear =  $film->getReleaseYear();
            $slug = $film->getSlug();
            $productionCompany = $film->getProductionCompany();
    
            $query->bindParam(':id', $id);
            $query->bindParam(':name', $name);
            $query->bindParam(':id_user', $idUser);
            $query->bindParam(':director', $director);
            $query->bindParam(':synopsys', $synopsis);
            $query->bindParam(':type', $type);
            $query->bindParam(':scriptwriter', $scriptwriter);
            $query->bindParam(':production_company', $productionCompany);
            $query->bindParam(':release_year', $releaseYear);
            $query->bindParam(':slug', $slug);
    
            $query->execute();
        } catch(PDOException $e) {
            die('Erreur de requête: ' . $e->getMessage());
        }
    }

    /**
     * Supprime une donnée dans la table film
     *
     * @param Int
     * @return void
     */
    public static function delete(int $id){
        try{
            $connexion = Model::getConnection();
            $query = $connexion->prepare("DELETE FROM Film WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
        } catch(PDOException $e) {
            die('Erreur de requête: ' . $e->getMessage());
        }
    }
    

    /**
     * Méthode permettant d'obtenir tous les enregistrements de la table film
     *
     * @return array
     */
    public static function getAllFromUser(int $idUser){
        $connexion = Model::getConnection();
        $query = $connexion->prepare("SELECT * FROM film WHERE id_user = :id_user");
        $query->bindParam(":id_user", $idUser);
        $query->execute();
        $films = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $film = new Film(
                $row['id'],
                $row['name'],
                $row['id_user'],
                $row['director'],
                $row['synopsys'],
                $row['type'],
                $row['scriptwriter'],
                $row['production_company'],
                $row['release_year'],
                $row['slug']
            );
            $films[] = $film;
        }
        return $films;  
    }

    /**
     * Méthode permettant d'obtenir un enregistrement de la table film en fonction d'un slug et id utilisateur
     *
     * @param Int
     * @param String
     * @return Film
     */
    public static function searchBySlugAndId(string $slug, int $idUser){
        try{
            $connexion = Model::getConnection();
            $query = $connexion->prepare("SELECT * FROM film WHERE slug = :slug AND id_user = :id_user");
            $query->bindParam(':slug', $slug);
            $query->bindParam(':id_user', $idUser);
            $query->execute();
            $dtbFilm = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur de requête: ' . $e->getMessage());
        }
        if (!$dtbFilm){
            return null;
        }
        return new Film($dtbFilm['id'], $dtbFilm['name'], $dtbFilm['id_user'], $dtbFilm['director'], $dtbFilm['synopsys'], $dtbFilm['type'], $dtbFilm['scriptwriter'], $dtbFilm['production_company'], $dtbFilm['release_year'], $dtbFilm['slug']);
    }
}
