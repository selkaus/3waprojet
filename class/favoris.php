<?php

class Favoris {
    private $id;
    private $id_user;
    private $id_item;
    private $date;

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function getIdUser(): int {
        return $this->id_user;
    }
    public function setIdUser(int $id_user): void {
        $this->id_user = $id_user;
    }
    
    public function getIdItem(): int {
        return $this->id_item;
    }
    public function setIdItem(int $id_item): void {
        $this->id_item = $id_item;
    }
    
    public function getDate(): string {
        return $this->date;
    }
    public function setDate(string $date): void {
        $this->date = $date;
    }
    
    
    
    public function save() {
        // Insert the favorite record into the database
        // Use a prepared statement to prevent SQL injection
        $query = "INSERT INTO favoris (date, id_user, id_item) VALUES (:date, :id_user, :id_item)";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ':id_user' => $this->id_user,
            ':id_item' => $this->id_item,
            ':date' => $this->date,
        ]);
    }

    public static function findByUserAndItem($userId, $itemId) {
        // Query the favorites table to check if the user has already added this item
        $query = "SELECT * FROM favoris WHERE id_user = :id_user AND id_item = :id_item";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ':id_user' => $userId,
            ':id_item' => $itemId,
        ]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Favoris");
        return $sth->fetch();
    }
    
    public static function findFavorisByUser($userId) {
        // Query the favorites table to retrieve the user's favorite items
        $query = "SELECT * FROM favoris WHERE id_user = :id_user";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ':id_user' => $userId,
        ]);
    
        // Fetch all favorite items and return them as an array
        $favoris = [];
        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $favori = new Favoris();
            $favori->setId($row['id']);
            $favori->setIdUser($row['id_user']);
            $favori->setIdItem($row['id_item']);
            $favori->setDate($row['date']);
            $favoris[] = $favori;
        }
    
        return $favoris;
    }
    
    public function isInFavoris($userId) {
        //Vérifie si l'objet est déjà dans les favoris
        $query = "SELECT * FROM favoris WHERE id_user = :id_user AND id_item = :id_item";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ':id_user' => $userId,
            ':id_item' => $this->id,
        ]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result !== false;
    }
    
    
    public static function removeFromFavoris($itemId, $userId): void {
        // Delete the favorite record from the database
        $query = "DELETE FROM favoris WHERE id_user = :id_user AND id_item = :id_item";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ':id_user' => $userId,
            ':id_item' => $itemId
        ]);
    }
}