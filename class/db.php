<?php

$host = "db.3wa.io";
$user = "";
$pwd = "";
$db = "";
$dsn = "";
$dbh = new PDO($dsn, $user, $pwd);

class Db {
    private static $instance = null; // Instance
    
    private $host;
    private $user;
    private $pwd;
    private $db;
    private $dsn;
    private $dbh;

    private function __construct () {
        $this->host = "db.3wa.io";
        $this->user = "selenafall";
        $this->pwd = "b6ee84be5c18b8b871b4f70b77c5eb35";
        $this->db = "selenafall_formulaire";
        $this->dsn = "mysql:dbname=".$this->db.";host=".$this->host;
        $this->dbh = new PDO($this->dsn, $this->user, $this->pwd);
    }

    private function __clone () {}

    public static function getDb() {
        if (is_null(Db::$instance)) {
            Db::$instance = new Db();
        }
        return Db::$instance;
    }
    
    public static function getDbh() {
        if (is_null(Db::$instance)) {
            Db::$instance = new Db();
        }
        return Db::$instance->dbh;
    }
}