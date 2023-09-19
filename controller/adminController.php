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
            $item->setPrix(intval($_POST['prix']));
            $item->setImage($_POST['image']);
            
            // Vérification des valeurs de l'objet user
            $result = $item->checkAddItemForm();
            
            // Si pas d'erreurs
            
            if ($result === true) {
                // Traitement du fichier
                // Basé sur : https://www.w3schools.com/php/php_file_upload.asp
                
                $target_dir = "public/uploads/";
                $target_file = $target_dir . basename($_FILES["imagefile"]["name"]);
                $uploadOk = true;
                
                //Securite = vérifier le type de fichier (l'extension)
                //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["imagefile"]["tmp_name"]);
                if ($check === true) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = true;
                } else {
                    //echo "File is not an image.";
                    $uploadOk = false;
                }
                
                move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
                
                // Lien entre fichier et BDD
                $item->setImage($target_file);
                
                // Si tout est ok, l'objet est ajouté dans la BDD
                $item->saveItem();
                header("Location: index.php?page=additem&success");                
                die;
            }
            
        }
        
        if (isset($_GET['success'])) {
            echo "Objet ajouté avec succès !";
        }
        
        //Affichage de la vue
        $vue = "view/addItemForm.phtml";
        require_once("view/template.phtml");
    }
    
    
    public static function modifItem() {
        // Si l'objet existe, accès à sa page de modification
        if (isset($_GET['id'])) {
            $item = Item::findById($_GET['id']);
            
            if (isset($_POST['modifier'])) {
                //Mettre les valeur POST dans l'objet Item
                $item->setCategorie($_POST['categorie']);
                $item->setNom($_POST['nom']);
                $item->setDescription($_POST['description']);
                $item->setPrix(intval($_POST['prix']));
                $item->setImage($_POST['image']);
                
                $item->editItem();
                
                header("Location: index.php?page=gestionitem");
                die;
            }
            
            $vue = "view/editItemForm.phtml";
            require_once("view/template.phtml");
        } else {
            //Sinon, affichage de la vue de gestion des objets
            $vue = "view/gestionItem.phtml";
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