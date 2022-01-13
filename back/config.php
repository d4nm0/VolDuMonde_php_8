<?php

class Database{

    // specify your own database credentials
    private $host;
    private $db_name;
    private $username;
    private $password = "";
    private $charset;
    public $connection;
    
    public function __construct() {
        
        $this->host    = 'localhost';
        $this->db_name = 'voldumonde';
        $this->username= 'root';
        $this->password= '';
        $this->charset = 'UTF8';
    }
    

    // get the database connection
    public function create_connection(){

        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->connection;
    }
}
?>