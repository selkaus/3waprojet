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
            // Instancier un objet Item
            $item = new Item();
            
            //Mettre les valeur POST dans l'objet Item
            $item->setCategorie($_POST['categorie']);
            $item->setNom($_POST['nom']);
            $item->setDescription($_POST['description']);
            $item->setPrix(intval($_POST['prix']));

            // Vérification des valeurs de l'objet user
            $result = $item->checkAddItemForm();
            
            // Si pas d'erreurs
            
            if ($result === true) {
                // Traitement du fichier
                // Basé sur : https://www.w3schools.com/php/php_file_upload.asp
                
                $target_dir = "public/uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOk = true;
                
                // N'upload pas si l'élément ajouté n'est pas une image. 
                //TODO: Ajouter un message d'erreur
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check === true) {
                    $uploadOk = true;
                } else {
                    $uploadOk = false;
                }
                
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                
                // Lien entre fichier et BDD
                $item->setImage($target_file);
                
                // Si tout est ok, l'objet est ajouté dans la BDD
                $item->saveItem();
                header("Location: index.php?page=additem&success=1");
                die;
            }
            
        }
        
        $successMessage = '';
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            $successMessage = '<p class="success">Objet ajouté avec succès !</p>';
        }
        
        //Affichage de la vue
        $vue = "view/addItemForm.phtml";
        require_once("view/template.phtml");
    }
    
    
    
    public static function modifItem() {
        if (isset($_GET['id'])) {
            $itemId = intval($_GET['id']);
            $item = Item::findById($itemId);
    
            if ($item) {
                if (isset($_POST['modifier'])) {
                    // Retrieve the current image file path
                    $currentImage = $_POST['current_image'];
    
                    // Update item properties
                    $item->setCategorie($_POST['categorie']);
                    $item->setNom($_POST['nom']);
                    $item->setDescription($_POST['description']);
                    $item->setPrix(intval($_POST['prix']));
    
                    // Check if a new image file was uploaded
                    if (!empty($_FILES['image']['name'])) {
                        // Process the uploaded image
                        $target_dir = "public/uploads/";
                        $target_file = $target_dir . basename($_FILES["image"]["name"]);
                        
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            // Update the image file path if the upload was successful
                            $item->setImage($target_file);
                        }
                    } else {
                        // Keep the current image file path if no new image was uploaded
                        $item->setImage($currentImage);
                    }
    
                    // Save the updated item
                    $item->editItem();
    
                    header("Location: index.php?page=gestionitem");
                    die;
                }
    
                $vue = "view/editItemForm.phtml";
                require_once("view/template.phtml");
            }
        }  else {
            $vue = "view/categorie.phtml";
            require_once("view/template.phtml");
        }
    }
    
    
    public static function gestionItem(){
        
        if (isset($_POST['supprItem'])) {
            $itemId = intval($_POST['supprItem']);
            
            Item::supprime($itemId);
        }
        
        if (isset($_POST['modifItem'])) {
            $itemId = intval($_POST['modifItem']);
            
            header("Location: index.php?page=modifitem&id=$itemId");
            die;
        }
        
        $items = Item::listAllItems();
        
        //Affichage de la vue
        $vue = "view/gestionItem.phtml";
        require_once("view/template.phtml");
    }

}