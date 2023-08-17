<?php

class UserController {
    public static function incription(){
        // Traitement
        
        // Affichage de la vue
        require_once("view/inscription.phtml");

    }
    
    public static function connexion(){
        require_once("view/connexion.phtml");

    }
}