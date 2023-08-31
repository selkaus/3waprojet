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
            
                    //Page de personnelle
                    if ($_GET['page'] == "espace") {
                        UserController::espacePersonnel();
                    }
            
            //Page de l'administrateur + liste des utilisateurs
            if ($_GET['page'] == "administration") {
                if (isset($_SESSION['admin'])) {
                    AdminController::accueilAdmin();
                } 
                //Pour la sécurité, si un user accède à la page administrative, redirection automatique vers la page des catégories d'objets
                else {
                    header("Location: index.php?page=categories");
                    die;
                }
            }
            
            //Page d'ajout d'objet pour l'administrateur
            if ($_GET['page'] == "additem") {
                if (isset($_SESSION['admin'])) {
                    AdminController::addItem();
                }
                //Ditto
                else {
                    header("Location: index.php?page=categories");
                    die;
                }
            }
            
            //Page de gestion des objets
            if ($_GET['page'] == "gestionitem") {
                if (isset($_SESSION['admin'])) {
                    AdminController::gestionItem();
                }
                //Ditto
                else {
                    header("Location: index.php?page=categories");
                    die;
                }
            }
            
            //Formulaire de modification d'objet
            if ($_GET['page'] == "modifitem") {
                if (isset($_SESSION['admin'])) {
                    AdminController::modifItem();
                }
                //Ditto
                else {
                    header("Location: index.php?page=categories");
                    die;
                }
            }
        }
        else {
        // Affichage de la page principale
        $vue = "view/index.phtml";
        require_once("view/template.phtml");        
        }
    
    }
}
