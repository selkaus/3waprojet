<?php

class AdminController {
    public static function accueilAdmin(){
        
        $users = User::listAllUsers();
        
        //Affichage de la vue
        $vue = "view/accueilAdmin.phtml";
        require_once("view/template.phtml");
    }
    
    public static function addItem() {
        if (isset($_POST['add'])) {
            // Instancier un objet item
            $item = new Item();
            
            //Mettre les valeur POST dans l'objet Item
            $item->setCategorie($_POST['categorie']);
            $item->setNom($_POST['nom']);
            $item->setDescription($_POST['description']);
            $item->setPrix($_POST['prix']);
            $item->setImage($_POST['image']);
        }
        
        //Affichage de la vue
        $vue = "view/addItemForm.phtml";
        require_once("view/template.phtml");
    }

}