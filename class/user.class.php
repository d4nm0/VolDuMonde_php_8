<?php

class User {
    // database connection and table name
    private $connection;
    private $table="user";
  
    // object properties
    public $user_id = '';
    public $name = '';
    public $password = '';
    public $email = '';
    public $admin = '';
    public $error_message;
    public $response;

    // constructor with $db as database connection
    public function __construct($connection){
        $this->connection = $connection;
    }
    
    public function check_connection(){
        
        $query = "SELECT COUNT(user_id) as cnt FROM user WHERE name = :name AND password = sha1(:password)";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':name', $this->name);
        $prepare->bindParam(':password', $this->password);
        if($prepare->execute()){
            return $prepare->fetch();
        }
        else{
            $this->error_message = $prepare->errorInfo();
            return false;
        }
    }
    public function getId(){
        $query= "SELECT user_id "
                . " FROM ".$this->table
                . " WHERE name = ? AND password=sha1(?)";
        $prepare= $this->connection->prepare($query);
        
        $prepare->bindParam(1, $this->name);
        $prepare->bindParam(2, $this->password);  
        
        if($prepare->execute()){
            return $prepare ->fetch()['user_id'];
        }else{
            return $prepare->errorInfo();
        }
    }
    public function AllUser(){
        $query= "SELECT * FROM user";
        $prepare= $this->connection->prepare($query);
        if($prepare->execute()){
            return $prepare ->fetchAll();
        }else{
            return $prepare->errorInfo();
        }
    }
    public function AddUser(){
        $query = "INSERT INTO `user` (`name`, `password`, `email`, `admin`) VALUES (:name , sha1(:password), :email, 0);";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':name', $this->name);
        $prepare->bindParam(':password', $this->password);
        $prepare->bindParam(':email', $this->email);
        if($prepare->execute()){
            $this->user_id = $this->connection->lastInsertId();
            return true;
        }
        else{
            $this->error_message = $prepare->errorInfo();
            print_r($this->error_message);
            return false;
        }
    }
}
?>