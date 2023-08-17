<?php

class UserController {
    public static function inscription(){
        // Traitement
        if (isset($_POST['inscription'])){
            // Instancier un objet User
            $user = new User();
            
            // Mettre les valeurs POST dans l'objet User
            $user->setNom($_POST['nom']);
            $user->setPrenom($_POST['prenom']);
            $user->setUsername($_POST['username']);
            $user->setPassword($_POST['password']);
            
            // Vérifier les valeurs de l'objet User
            if ($user->checkInscriptionForm($_POST['password2'])){
                // Si tout est ok, on sauvegarde l'User
                $user->save();
                // Eventuellement, redirection au lieu d'afficher la vue inscription
            } else {
                echo "Ca marche pas";
            }
        }
        
        // Affichage de la vue
        $vue = "view/inscription.phtml";
        require_once("view/template.phtml");

    }
    
    public static function connexion(){
        if (isset($_POST['connexion'])){
            // Instancier un objet User
            $user = new User();
            
            // Mettre les valeurs POST dans l'objet User
            $user->setUsername($_POST['username']);
            $user->setPassword($_POST['password']);
            
            // Vérifier les données dans la bdd
            if ($user->checkConnexionForm()){
                echo "c'est bon";
            } else {
                echo "Ca marche pas";
            }
        }
        require_once("view/connexion.phtml");

    }
}