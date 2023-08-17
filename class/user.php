<?php  

class User {
    private $id;
    private $nom;
    private $prenom;
    private $username;
    private $password;
    private $admin;
    
    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function getNom(): string {
        return $this->nom;
    }
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }
    
    public function getPrenom(): string {
        return $this->prenom;
    }
    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }
    
    public function getUsername(): string {
        return $this->username;
    }
    public function setUsername(string $username): void {
        $this->username = $username;
    }
    
    public function getPassword(): string {
        return $this->password;
    }
    public function setPassword(string $password): void {
        $this->password = $password;
    }
    
    public function getAdmin(): bool {
        return $this->admin;
    }
    public function setAdmin(bool $admin): void {
        $this->admin = $admin;
    }
    
    
    public function checkInscriptionForm($password2=""): bool{
        if (empty($this->nom)) {
            return false;
        }
        if (empty($this->prenom)) {
            return false;
        }
        if (empty($this->username)) {
            return false;
        }
        if (empty($this->password)) {
            return false;
        }
        if ($this->password != $password2) {
            return false;
        }
        return true;
    }
    
    public function save(){
        if (empty($this->id)) {
            // Pas d'id = création = insert
            $query="INSERT INTO user (nom, prenom, username, password) VALUES (:nom, :prenom, :username, :password)";
            $sth = Db::getDbh()->prepare($query);
            $sth->execute([
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
                ':username' => $this->username,
                ':password' => password_hash($this->password, PASSWORD_DEFAULT),
            ]);
        }
        else {
            // id = modification = update
        }
    }
    
    
    public function checkConnexionForm(){
        
        // Test avec la BDD
        $query = "SELECT id, username, password, admin FROM user WHERE username=:username";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":username" => $this->username,
        ]);
        
        // Test password
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            if (password_verify($this->password, $row['password'])) {
                $_SESSION['ID'] = $row['id'];
                if ($row['admin']) {
                    $_SESSION['admin'] = true;
                }
                return true;
            }
        }
        return false;
    }
    
}