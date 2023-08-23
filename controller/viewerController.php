<?php

class ViewerController {
    public static function contact(){
        //Affichage de la vue
        $vue = "view/contactViewers.phtml";
        require_once("view/template.phtml");

    }
}