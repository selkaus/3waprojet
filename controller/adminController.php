<?php

class AdminController {
    public static function accueilAdmin(){
        
        $users = User::listAllUsers();
        
        //Affichage de la vue
        $vue = "view/accueilAdmin.phtml";
        require_once("view/template.phtml");
    }
    
    public static function addItem() {
        //Affichage de la vue
        $vue = "view/addItemForm.phtml";
        require_once("view/template.phtml");
    }

}