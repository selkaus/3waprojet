<?php

class MessageController {
    
    public static function sendMessage() {
        if (isset($_POST['sendMessage'])) {
            
            // Instancie un objet message
            $message = new Message();
            
            // Met les valeurs POST dans l'objet
            $message->setText($_POST['text']);
            $message->setIdUser($_SESSION['ID']);
            $message->save();

            // Redirection vers la page de contact
            header("refresh:5;url=index.php?page=contact");
            
            // Affichage de la vue
            $vue = "view/confirmMessage.phtml";
            require_once("view/template.phtml");
            
        }
    }
    
   /* public function AdminMessages() {
        
        if ($_SESSION['admin']) {
            // Code to fetch and display admin's messages
            $messages = Message::getAdminMessages();
            include('views/admin_messages.php');
        }
    }*/

}