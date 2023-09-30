<?php

class ItemController {
    public static function listeCategories(){
        $items = [];
        $favoris = [];
        
        if (isset($_GET['categorie'])) {
            $items = Item::listAllItemsByCategory($_GET['categorie']);
        } else {
            $items = Item::listAllItems();
        }
        
        if (isset($_SESSION['ID'])) {
            $userId = $_SESSION['ID'];
            $favoris = Favoris::findFavorisByUser($userId);
        
            // Loop through items to set isInFavorites property
            foreach ($items as $item) {
                $item->setIsInFavorites(false); // Initialize to false
                foreach ($favoris as $favori) {
                    if ($favori->getIdItem() === $item->getId()) {
                        $item->setIsInFavorites(true); // Set to true if found in favorites
                        break;
                    }
                }
            }
            
            
        }
        
        // Affichage de la vue
        $vue = "view/categories.phtml";
        require_once("view/template.phtml");
    }
    

    public static function addToFavoris() {
        if (isset($_POST['id_item']) && isset($_SESSION['ID'])) {
            $itemId = intval($_POST['id_item']);
            $userId = $_SESSION['ID'];

            // Check if the item already exists in the user's favorites
            $existingFavoris = Favoris::findByUserAndItem($userId, $itemId);

            if (!$existingFavoris) {
                // Create a new favorite record
                $favoris = new Favoris();
                $favoris->setIdUser($userId);
                $favoris->setIdItem($itemId);
                $favoris->setDate(date('Y-m-d H:i:s')); // Set the current date and time
                $favoris->save();
            }

            // Redirect the user to their personal page
            header("Location: index.php?page=categories");
            die();
        } else {
            // Handle errors or invalid requests
            // You can display an error message or redirect to a specific page
            header("Location: index.php");
            die();
        }
    }
    
    public static function showFavoris() {
        if (isset($_SESSION['ID'])) {
            $userId = $_SESSION['ID'];
    
            $favoris = Favoris::findFavorisByUser($userId);
    
            $user = User::findById($userId);
    
            // Get all items
            $items = Item::listAllItems();
    
            // Loop through the items to check if they are in favorites
            foreach ($items as $item) {
                $item->isInFavorites = false; // Initialize to false
                foreach ($favoris as $favori) {
                    if ($favori->getIdItem() === $item->getId()) {
                        $item->isInFavorites = true; // Set to true if found in favorites
                        break;
                    }
                }
            }
    
            $vue = "view/espace.phtml";
            require_once("view/template.phtml");
        } else {
            header("Location: index.php");
            die();
        }
    }
    
    
    public static function removeFromFavoris() {
        if (isset($_POST['id_item']) && isset($_SESSION['ID'])) {
            $itemId = intval($_POST['id_item']);
            $userId = $_SESSION['ID'];
    
            // Remove the item from favorites
            Favoris::removeFromFavoris($itemId, $userId);
        }
    
        // Redirect the user back to their favorites page
        header("Location: index.php?page=espace");
        die();
    }
    
}