<?php

class ItemController {
    public static function listeCategories(){
        $items = [];
        if (isset($_GET['categorie'])) {
            $items = Item::listAllItemsByCategory($_GET['categorie']);
        } else {
            $items = Item::listAllItems();
        }
        
        // Affichage de la vue
        $vue = "view/categories.phtml";
        require_once("view/template.phtml");
    }
}