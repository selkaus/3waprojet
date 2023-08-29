<?php

class Router {
    public static function route() {
        if (isset($_GET['page'])) {
            
            //Page des catégories
            if ($_GET['page'] == "categories") {
                itemController::listeCategories();
            }
            
            //Page des objets
            
            //Page d'inscription
            if ($_GET['page'] == "inscription") {
                UserController::inscription();
            }
            
            //Page de connexion
            if ($_GET['page'] == "connexion") {
                UserController::connexion();
            }
            
            //Page de déconnexion
            if ($_GET['page'] == "deconnexion") {
                UserController::deconnexion();
            }
            
            //Page de contact
            if ($_GET['page'] == "contact") {
                UserController::contact();
            }
            
            //Page de l'administrateur + liste des utilisateurs
            if ($_GET['page'] == "administration") {
                if (isset($_SESSION['admin'])) {
                    // Accès à la page de contact en tant qu'utilisateur (connecté)
                    AdminController::accueilAdmin();
                } else {
                    // @TODO : Redirection page des catégorie d'objets
                }
            }
            
            //Page d'ajout d'objet pour l'admin
            if ($_GET['page'] == "additem") {
                if (isset($_SESSION['admin'])) {
                    // Accès à la page de contact en tant qu'utilisateur (connecté)
                    AdminController::addItem();
                } else {
                    // @TODO : Redirection page des catégories d'objets
                }
            }
            
            //Page de modification d'objets
            
        }
        else {
        // Affichage de la page principale
        $vue = "view/index.phtml";
        require_once("view/template.phtml");        
        }
    
    }
}
