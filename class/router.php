<?php

class Router {
    public static function route(){
        if (isset($_GET['page'])) {
            if ($_GET['page'] == "inscription") {
                UserController::inscription();
            }
            if ($_GET['page'] == "connexion") {
                UserController::connexion();
            }
        }
        else {
            // Affichage du template
            require_once("view/index.phtml");   
        }
        
    }
}