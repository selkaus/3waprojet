<?php  

//Objets mis en vente sur le site par l'administrateur du site
class Item {
    private $id;
    private $categorie;
    private $nom;
    private $description;
    private $prix;
    private $image;
    
    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function getCategorie(): string {
        return $this->categorie;
    }
    public function setCategorie(string $categorie): void {
        $this->categorie = $categorie;
    }
    
    public function getNom(): string {
        return $this->nom;
    }
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }
    
    public function getDescription(): string {
        return $this->description;
    }
    public function setDescription(string $description): void {
        $this->description = $description;
    }
    
    public function getPrix(): float {
        return $this->prix;
    }
    public function setPrix(int $prix): void {
        $this->prix = $prix;
    }
    
    public function getImage(): string {
        return $this->image;
    }
    public function setImage(string $image): void {
        $this->image = $image;
    }
    
    
    // Function vérifiant la validité du formulaire d'ajout d'objet
    public function checkAddItemForm(): mixed {
        if (empty($this->categorie)) {
            return "La catégorie n'a pas été selectionnée";
        }
        if (empty($this->nom)) {
            return "Le nom/titre n'a pas été saisi";
        }
        if (empty($this->description)) {
            return "La description n'a pas été saisie";
        }
        if (empty($this->image)) {
            return "L'image n'a pas été selectionnée";
        }
        
        // Si le nom/titre de l'objet est déjà dans la BDD
        if (Item::findByNom($this->nom)) {
            return "Ce nom/titre d'objet existe déjà";
        }
        return true;
    }
        
        
    // Function pour récuperer le nom dans la BDD
    public static function findByNom(string $nom): mixed {
        $query = "SELECT * FROM item WHERE nom=:nom";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":nom" => $nom,
        ]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Item");
        return $sth->fetch();
    }
    
    
    // Function pour récuperer l'Id dans la BDD
    public static function findById(int $id): mixed {
        $query = "SELECT * FROM item WHERE id=:id";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":id" => $id,
        ]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Item");
        return $sth->fetch();
    }
    

    // Fonction qui ajoute l'item dans la BDD
    public function saveItem(){
        //Si l'id n'existe pas, la sauvegarde dans la BDD s'effectue
        if (empty($this->id)) {
            $query="INSERT INTO item (categorie, nom, description, prix, image) VALUES (:categorie, :nom, :description, :prix, :image)";
            $sth = Db::getDbh()->prepare($query);
            $sth->execute([
                ':categorie' => $this->categorie,
                ':nom' => $this->nom,
                ':description' => $this->description,
                ':prix' => $this->prix,
                ':image' => $this->image,
            ]);
        }
    }
    
    
    public function editItem(){
        if (!empty($this->id)) {
            $query="UPDATE item SET categorie=:categorie, nom=:nom, description=:description, prix=:prix, image=:image WHERE id=:id";
            $sth = Db::getDbh()->prepare($query);
            $sth->execute([
                ':categorie' => $this->categorie,
                ':nom' => $this->nom,
                ':description' => $this->description,
                ':prix' => $this->prix,
                ':image' => $this->image,
                ':id' => $this->id,
            ]);
        }
    }
    

    public static function listAllItems(): mixed {
        $query = "SELECT * FROM item";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Item");
    }
    
    public static function listAllItemsByCategory($categorie): mixed {
        $query = "SELECT * FROM item WHERE categorie=:categorie";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ':categorie' => $categorie
            ]);
        return $sth->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Item");
    }
        
    public static function supprime($id): void {
        $query = "DELETE FROM item WHERE id=:id";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ':id' => $id
        ]);
    }
}
    