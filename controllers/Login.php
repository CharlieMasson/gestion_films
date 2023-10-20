<?php
require_once(ROOT.'classes/User.php');
require_once(ROOT.'app/SessionManager.php');

class Login extends Controller{
    /**
     * Cette méthode permet a un utilisateur de s'enregistrer
     *
     * @return void
     */
    public function index(){
        session_start();
        // redirige si une session est en cours
        if (SessionManager::isSessionActive()){
            header("Location: ./Films");
        }
        // On instancie le modèle "Film"
        $this->loadModel('UserModel');
        $messages = array();

        if (isset($_POST['submit'])){
            // verif que les champs sont tous remplis
            if (empty($_POST['username']) || empty($_POST['password'])){
                $messages[] = "Tous les champs doivent être remplis. <br>";
                $this->render('index',  ['messages' => $messages], false);
            }
            //verif que l'utilisateur existe dans la bdd
            $user = UserModel::searchByUsername($_POST['username']);
            if ($user === null){
                $messages[] = "Erreur dans le mot de passe et/ou identifiant. <br>";
                $this->render('index',  ['messages' => $messages], false);
            } else {
                //verif que le mdp est bon
                if (!password_verify($_POST['password'], $user->getPassword())) {
                    $messages[] = "Erreur dans le mot de passe et/ou identifiant. <br>";
                } else {
                    SessionManager::createSession($user->getUsername(), $user->getId());
                    header("Location: ./Films/Dashboard");
                }
            }
        }
        $this->render('index',  ['messages' => $messages, 'sentForm' => $_POST], false);
    }
}
