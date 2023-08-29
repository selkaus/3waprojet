<?php

class ItemController {
    public static function listeCategories(){
        //Affichage de la vue
        $vue = "view/categories.phtml";
        require_once("view/template.phtml");
    }
}