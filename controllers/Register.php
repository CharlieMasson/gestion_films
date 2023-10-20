<?php
require_once(ROOT.'classes/User.php');
require_once(ROOT.'app/SessionManager.php');

class Register extends Controller{
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
        $successMessage = "";
        if (isset($_POST['submit'])){
            $noError = true;
            // verif que les champs sont tous remplis
            if (empty($_POST['username']) || empty($_POST['password']) ||empty($_POST['passwordConf']) || empty($_POST['email'])){
                $messages[] = "Tous les champs doivent être remplis. <br>";
                $noError = false;
            }
            //verif que le mdp correspond aux normes de la CNIL
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{12,}$/';
            if (!preg_match($pattern, $_POST['password'])){
                $messages[] = "Le mot de passe n'est pas assez sécurisé. <br>";
                $noError = false;
            }
            //verif que les chaines ne sont pas trop longues
            $maxCharLimit = 50;
            if (strlen($_POST['username']) > $maxCharLimit || strlen($_POST['email']) > $maxCharLimit || strlen($_POST['password']) > $maxCharLimit || strlen($_POST['passwordConf']) > $maxCharLimit) {
                $messages[] = "Les champs ne doivent pas dépasser ".$maxCharLimit." caraactères";
                $noError = false;
            }
            //verif que le mdp et la verif du mdp correspondent
            if ($_POST['password'] !== $_POST['passwordConf']){
                $messages[] = "Les mots de passes ne correspondent pas. <br>";
                $noError = false;
            }
            //verif que le mdp ne contient pas le pseudonyme
            if (strpos($_POST['password'], $_POST['username']) !== false){
                $messages[] = "Le mot de passe ne peut pas contenir votre pseudonyme. <br>";
                $noError = false;
            }
            if ($noError){
                //verif que l'adresse email ou que le mdp n'est pas déjà utilisé
                $user = new User(0, htmlspecialchars($_POST['username']), $_POST['password'], htmlspecialchars($_POST['email']), date('Y-m-d H:i:s'));
                if (UserModel::searchByEMail($user->getEmail())) {
                    $messages[] = "Un compte est déjà associé à cette adresse email.";
                    $noError = false;
                }
                if (UserModel::searchByUsername($user->getUsername())) {
                    $messages[] = "Pseudonyme déjà utilisé.";
                    $noError = false;
                }
                
                if ($noError){
                    UserModel::create($user);
                    $successMessage = "<a href='./Login'>Votre compte a été créé avec succès! Vous pouvez maintenant vous connecter...</a>";
                    $this->render('success',  ['successMessage' => $successMessage], false);
                }
            }
        }
        $this->render('index',  ['messages' => $messages, 'sentForm' => $_POST], false);
    }
}
