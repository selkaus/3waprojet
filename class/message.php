<?php

class Message {
    private $id;
    private $date;
    private $text;
    private $id_user;
    
    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function getDate(): string {
        return $this->date;
    }
    public function setDate(string $date): void {
        $this->date = $date;
    }
    
    public function getText(): string {
        return $this->text;
    }
    public function setText(string $text): void {
        $this->text = $text;
    }
    
    public function getIdUser(): int {
        return $this->id_user;
    }
    public function setIdUser(int $id_user): void {
        $this->id_user = $id_user;
    }
    
    
    // @TODO: Vérifier que le message n'est pas vide


    // Fonction qui enregistre le message dans la BDD
    public function save(){
            $query="INSERT INTO message (date, text, id_user) VALUES (NOW(), :text, :id_user)";
            $sth = Db::getDbh()->prepare($query);
            $sth->execute([
                ':text' => $this->text,
                ':id_user' => $this->id_user,
            ]);
        }
}