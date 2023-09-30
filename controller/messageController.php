<?php

class MessageController {
    
    public static function sendMessage() {
        if (isset($_POST['send_message'])) {
            
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
    
   public static function messagesRecus(){
        
        $messages = Message::listAllMessages();
        
        //Affichage de la vue
        $vue = "view/messagerie.phtml";
        require_once("view/template.phtml");
    }

}