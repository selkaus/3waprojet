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
            $user->setEmail($_POST['email']);
            $user->setUsername($_POST['username']);
            $user->setPassword($_POST['password']);
            
            // Vérification des valeurs de l'objet user
            $result = $user->checkInscriptionForm($_POST['password2']);
            
            // Si pas d'erreur dans les infos d'inscription
            if ($result === true) {
                // Si tout est ok, on sauvegarde l'user
                $user->save();
                header( "refresh:5;url=index.php" );
                
                echo "Inscription confirmée, vous pouvez vous connecter.<br>Redirection vers la page de connexion.";
                
                die;
            }
            
            // En cas d'échec d'inscription
            else {
                echo "Erreur d'inscription, veuillez verifier les données entrées : $result";
            }
        }
        
        //Affichage de la vue
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
                $vue = "view/index.phtml";
                require_once("view/template.phtml");
            } else {
                echo "Le nom d'utilisateur et/ou le mot de passe n'existe(nt) pas.";
            }
        }
        
        //Affichage de la vue
        $vue = "view/connexion.phtml";
        require_once("view/template.phtml");

    }
    
    public static function deconnexion() {
        //Retire la session de l'utilisateur
        $_SESSION['ID'] = null;         
        unset($_SESSION['ID']);     
        session_destroy();
        
        //Redirection vers la page de connexion
        header( "refresh:3;url=index.php?page=connexion" );
        
        //Affichage de la vue
        $vue = "view/deconnexion.phtml";
        require_once("view/template.phtml");
        }
        
    
    public static function contact(){
        //Affichage de la vue
        $vue = "view/contact.phtml";
        require_once("view/template.phtml");

    }
}