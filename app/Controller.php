<?php
abstract class Controller{
    /**
     * Afficher une vue
     *
     * @param string $file
     * @param array $data
     * @return void
     */
    public function render(string $file, array $data = [], bool $displayMenu = true){
        extract($data);
        // On démarre le buffer de sortie
        ob_start();
        // On génère la vue
        require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$file.'.php');
        // On stocke le contenu dans $content
        $content = ob_get_clean();
        // On fabrique le "template"
        if ($displayMenu){
            require_once(ROOT.'views/layout/default.php');
        } else {
            require_once(ROOT.'views/layout/noMenu.php');
        }
    }

    /**
     * Permet de charger un modèle
     *
     * @param string $model
     * @return void
     */
    public function loadModel(string $model){
        // On va chercher le fichier correspondant au modèle souhaité
        require_once(ROOT.'models/'.$model.'.php');
        // On crée une instance de ce modèle. 
        $this->$model = new $model();
    }
}
