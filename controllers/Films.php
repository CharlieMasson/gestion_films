<?php
require_once(ROOT.'classes/Film.php');
require_once(ROOT.'app/SessionManager.php');

class Films extends Controller{
    public function index(){
        session_start();
        //redirige si pas de session
        if (!SessionManager::isSessionActive()){
            header("Location: ../Login");
        }
        header("Location: ./Dashboard");
    }
    /**
     * Cette méthode affiche la liste des films
     *
     * @return void
     */
    public function dashboard(){
        session_start();
        //redirige si pas de session
        if (!SessionManager::isSessionActive()){
            header("Location: ../Login");
        }
        // On instancie le modèle "Film"
        $this->loadModel('FilmModel');
        // On stocke la liste des articles dans $films
        $films = FilmModel::getAllFromUser($_SESSION['id']);
        // On envoie les données à la vue index
        $this->render('dashboard', ['films' => $films]);
    }

    public function add(){
        session_start();
        //redirige si pas de session
        if (!SessionManager::isSessionActive()){
            header("Location: ../Login");
        }
        // On instancie le modèle "Film"
        $this->loadModel('FilmModel');
        $messages = array();
        $successMessage = "";
        if (isset($_POST['submit'])){
            $noError = true;
            // Verifie que tout les champs sont remplis
            if (empty($_POST['name']) || empty($_POST['director']) || empty($_POST['scriptwriter']) || empty($_POST['production_company']) || empty($_POST['release_year'])){
                $messages[] = "Tous les champs sauf synopsis doivent être remplis. <br>";
                $noError = false;
            }
            //verif que la date et que le nom du film sont réaliste
            $pattern = '/[a-zA-Z0-9]/';
            $yearPattern = '/^\d{4}$/';
            if (!preg_match($yearPattern, $_POST['release_year'])){
                $messages[] = "Veuillez renseigner une année réaliste. <br>";
                $noError = false;
            }
            if (!preg_match($pattern, $_POST['name'])){
                $messages[] = "Veuillez renseigner un nom réaliste. <br>";
                $noError = false;
            }
            //verif que les chaines ne sont pas trop longues
            $maxCharLimit = 50;
            $synopsisMaxCharLimit = 250;
            if (strlen($_POST['name']) > $maxCharLimit || strlen($_POST['director']) > $maxCharLimit || strlen($_POST['scriptwriter']) > $maxCharLimit || strlen($_POST['production_company']) > $maxCharLimit || strlen($_POST['release_year']) > $maxCharLimit || strlen($_POST['synopsis']) > $synopsisMaxCharLimit) {
                $messages[] = "Les champs ne doivent pas dépasser ".$maxCharLimit." caraactères (".$synopsisMaxCharLimit." caractères pour le synopsis.)";
                $noError = false;
            }
            if ($noError){
                $slug = Film::slugify($_POST['name']."-by-".$_POST['director']);
                if (FilmModel::searchBySlugAndId($slug, $_SESSION['id'])) {
                    $messages[] = "Une entrée de ce réalisteur existe déjà avec ce nom.";
                } else {
                    $film = new Film(
                        0,
                        htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($_SESSION['id'], ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($_POST['director'], ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($_POST['synopsis'], ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($_POST['type'], ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($_POST['scriptwriter'], ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($_POST['production_company'], ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($_POST['release_year'], ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'),
                    );
                    FilmModel::create($film);
                    $successMessage = "Le film a bien été ajouté!";
                    $this->render('success', ['successMessage' => $successMessage]);
                }
            }
        }
        $this->render('add', ['messages' => $messages, 'sentForm' => $_POST]);
    }

    public function modify($slug = "") {
        session_start();
        // Redirige si pas de session
        if (!SessionManager::isSessionActive()) {
            header("Location: ../Login");
        }
        $this->loadModel('FilmModel');
        $messages = array();
        $successMessage = "";
        // récupère le film correspond au slug et à l'id de l'utilisateur
        $film = FilmModel::searchBySlugAndId($slug, $_SESSION['id']);
        if (!$film) {
            // redirige l'utilisateur si il n'a pas de film avec ce slug
            if ($slug === ""){
                header("Location: ./Dashboard");
            } else {
                header("Location: ../Dashboard");
            }
        }
        if (isset($_POST['submit'])) {
            $noError = true;
            // Verifie que tout les champs sont remplis
            if (empty($_POST['name']) || empty($_POST['director']) || empty($_POST['scriptwriter']) || empty($_POST['production_company']) || empty($_POST['release_year'])){
                $messages[] = "Tous les champs sauf synopsis doivent être remplis. <br>";
                $noError = false;
            }
            //verif que la date et que le nom du film sont réaliste
            $pattern = '/[a-zA-Z0-9]/';
            $yearPattern = '/^\d{4}$/';
            if (!preg_match($yearPattern, $_POST['release_year'])){
                $messages[] = "Veuillez renseigner une année réaliste. <br>";
                $noError = false;
            }
            if (!preg_match($pattern, $_POST['name'])){
                $messages[] = "Veuillez renseigner un nom réaliste. <br>";
                $noError = false;
            }
            //verif que les chaines ne sont pas trop longues
            $maxCharLimit = 50;
            $synopsisMaxCharLimit = 250;
            if (strlen($_POST['name']) > $maxCharLimit || strlen($_POST['director']) > $maxCharLimit || strlen($_POST['scriptwriter']) > $maxCharLimit || strlen($_POST['production_company']) > $maxCharLimit || strlen($_POST['release_year']) > $maxCharLimit || strlen($_POST['synopsis']) > $synopsisMaxCharLimit) {
                $messages[] = "Les champs ne doivent pas dépasser ".$maxCharLimit." caraactères (".$synopsisMaxCharLimit." caractères pour le synopsis.)";
                $noError = false;
            }
    
            if ($noError) {
                $slug = Film::slugify($_POST['name']."-by-".$_POST['director']);
                //si l'utilusateur modifie le slug(nom) du film et un autre film de l'utilisateur a ce slug, alors retourne une erreur
                if ($film->getSlug() !== $slug && FilmModel::searchBySlugAndId($slug, $_SESSION['id'])){
                    $messages[] = "Une entrée de ce réalisateur existe déjà avec ce nom.";
                    $noError = false;
                }
                if($noError) {
                    // change les données de l'objet film
                    $film->setName(htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'));
                    $film->setDirector(htmlspecialchars($_POST['director'], ENT_QUOTES, 'UTF-8'));
                    $film->setSynopsis(htmlspecialchars($_POST['synopsis'], ENT_QUOTES, 'UTF-8'));
                    $film->setType(htmlspecialchars($_POST['type'], ENT_QUOTES, 'UTF-8'));
                    $film->setScriptwriter(htmlspecialchars($_POST['scriptwriter'], ENT_QUOTES, 'UTF-8'));
                    $film->setProductionCompany(htmlspecialchars($_POST['production_company'], ENT_QUOTES, 'UTF-8'));
                    $film->setReleaseYear(htmlspecialchars($_POST['release_year'], ENT_QUOTES, 'UTF-8'));
                    // modification du film dans la bdd
                    FilmModel::modify($film);
                    $successMessage = "Le film a bien été modifié!";
                    $this->render('success', ['successMessage' => $successMessage]);
                }
            }
        }
    
        $this->render('modify', ['messages' => $messages, 'film' => $film, 'sentForm' => $_POST]);
    }
    
    public function delete($slug = "") {
        session_start();
        // Redirige si pas de session
        if (!SessionManager::isSessionActive()) {
            header("Location: ../Login");
        }
        $this->loadModel('FilmModel');
        $messages = array();
        $successMessage = "";
        // récupère le film correspond au slug et à l'id de l'utilisateur
        $film = FilmModel::searchBySlugAndId($slug, $_SESSION['id']);
        if (!$film) {
            // redirige l'utilisateur si il n'a pas de film avec ce slug
            if ($slug === ""){
                header("Location: ./Dashboard");
            } else {
                header("Location: ../Dashboard");
            }
        }
        if (isset($_POST['submit'])) {
            // supprime le film via son id
            FilmModel::delete($film->getId());
    
            $successMessage = "Le film a bien été supprimé!";
            $this->render('success', ['successMessage' => $successMessage]);
        }
    
        $this->render('delete', ['film' => $film]);
    }
    
}
