<?php  

// Utilisateurs connectés au site
class User {
    private $id;
    private $nom;
    private $prenom;
    private $email;
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
    
    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
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
    
    
    // Function vérifiant la validité du formulaire d'inscription
    public function checkInscriptionForm($password2=""): mixed {
        if (empty($this->nom)) {
            return "Le nom n'a pas été saisi";
        }
        if (empty($this->prenom)) {
            return "Le prénom n'a pas été saisi";
        }
        if (empty($this->email)) {
            return "L'email n'a pas été saisi";
        }
        if (empty($this->username)) {
            return "Le nom d'utilisateur n'a pas été saisi";
        }
        if (empty($this->password)) {
            return "Le mot de passe n'a pas été saisi";
        }
        if ($this->password != $password2) {
            return "Les mots de passe ne correspondent pas";
        }
        // Si le nom d'utilisateur est déjà dans la BDD
        if (User::findByUsername($this->username)) {
            return "Ce nom d'utilisateur existe déjà";
        }
        // Si l'email est déjà dans la BDD
        if (User::findByEmail($this->email)) {
            return "cet email existe déjà";
        }
        return true;
    }
    
    
    // Récupère l'Id
    public static function findById(int $id): mixed {
        $query = "SELECT * FROM user WHERE id=:id";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":id" => $id,
        ]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
        return $sth->fetch();
    }
    
    
    // Function pour récuperer les noms d'utilisateurs de la BDD
    public static function findByUsername(string $username): mixed {
        $query = "SELECT * FROM user WHERE username=:username";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":username" => $username,
        ]);
        $sth->setFetchMode(PDO::FETCH_CLASS, "User");
        return $sth->fetch();
    }

    // Function pour récuperer les email de la BDD
    public static function findByEmail(string $email): mixed {
        $query = "SELECT * FROM user WHERE email=:email";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":email" => $email,
        ]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
        return $sth->fetch();
    }
    
    // Fonction qui enregistre l'utilisateur dans la BDD
    public function save(){
        // Si email, username, et id n'existent pas, la sauvegarde dans la BDD s'effectue
        if (empty($this->id)) {
            $query="INSERT INTO user (nom, prenom, email, username, password) VALUES (:nom, :prenom, :email, :username, :password)";
            $sth = Db::getDbh()->prepare($query);
            $sth->execute([
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
                ':email' => $this->email,
                ':username' => $this->username,
                ':password' => password_hash($this->password, PASSWORD_DEFAULT),
            ]);
        }
    }
    
    // Vérifie que le formulaire est correct
    public function checkConnexionForm(){
        
        // Vérifie que l'utilisteur existe dans la BDD
        $query = "SELECT id, username, password, admin FROM user WHERE username=:username";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":username" => $this->username,
        ]);
        
        // Verifie que le mot de passe entré matche le mot de passe de la BDD
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
    
    public static function listAllUsers(): mixed {
        $query = "SELECT * FROM user";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
    }
}