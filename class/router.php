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
            if ($_GET['page'] == "sendmessage") {
                MessageController::sendMessage();
            }
            
            if ($_GET['page'] == "espace") {
                if (isset($_SESSION['ID'])) {
                   UserController::espacePersonnel();
                }
                //Si un visiteur accède à la page espace, redirection automatique vers la page de connexion
                else {
                    header("Location: index.php?page=connexion");
                    die;
                }
            }
            
            if ($_GET['page'] == "favoris") {
                if (isset($_SESSION['ID'])) {
                    ItemController::addToFavoris(); 
                }
                else {
                    $vue = "view/categories.phtml";
                    require_once("view/template.phtml");
                }
            }
            
            if ($_GET['page'] == "remove-fav") {
                ItemController::removeFromFavoris();
            }
            
            //Page des Mentions Légales
            if ($_GET['page'] == "mention-legales") {
                $vue = "view/mentionLegales.phtml";
                require_once("view/template.phtml"); 
            }
            
            //Page des Condition Générales d'Utilisation
            if ($_GET['page'] == "cgu") {
                $vue = "view/cgu.phtml";
                require_once("view/template.phtml"); 
            }
            
            //Page de la Politique de Confidentialité
            if ($_GET['page'] == "politique-de-confidetialite") {
                $vue = "view/privacyPolicy.phtml";
                require_once("view/template.phtml"); 
            }
            
            //Page A propos de nous
            if ($_GET['page'] == "aboutus") {
                $vue = "view/aboutUs.phtml";
                require_once("view/template.phtml"); 
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
            
            //Confirmation envoi de message
            if ($_GET['page'] == "confirmationmessage") {
                if (isset($_SESSION['ID'])) {
                    MessageController::confirmMessage();
                }
                //Pour la sécurité, si un user ou visiteur accède à la page administrative, redirection automatique vers la page de contact
                else {
                    header("Location: index.php?page=contact");
                    die;
                }
            }
                
            //Messages pour l'administrateur
            if ($_GET['page'] == "messagerie") {
                if (isset($_SESSION['admin'])) {
                    MessageController::messagesRecus();
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
