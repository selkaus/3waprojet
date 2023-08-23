<?php

class Router {
    public static function route() {
        if (isset($_GET['page'])) {
            if ($_GET['page'] == "inscription") {
                UserController::inscription();
            }
            if ($_GET['page'] == "connexion") {
                UserController::connexion();
            }
            if ($_GET['page'] == "contact") {
                if (isset($_SESSION['ID'])) {
                    // Accès à la page de contact en tant qu'utilisateur (connecté)
                    UserController::contact();
                } else {
                    // Accès à la page de contact en tant que visiteur (non connecté)
                    ViewerController::contact();
                }
            }
        }
        else {
            // Affichage de la page principale
            require_once("view/index.phtml");   
        }
        
    }
}