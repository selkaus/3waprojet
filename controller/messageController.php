<?php

class MessageController {
    public function sendMessage() {
        if (isset($_POST['sendMessage'])) {
            
            $text = $_POST['message'];
            $userId = $_SESSION['user_id']; // Assuming you have user authentication and session management

            // Code to create a new message and store it in the database
            $message = new Message();
            $message->setText($text);
            $message->setUserId($userId);
            $message->save();

            // Redirect or display a success message
        }
    }

    public function showAdminMessages() {
        // Assuming you have an authentication system for admin users
        if ($_SESSION['admin']) {
            // Code to fetch and display admin's messages
            $messages = Message::getAdminMessages();
            include('views/admin_messages.php');
        }
    }

}