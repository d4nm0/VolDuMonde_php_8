<?php

class Vol {
    // database connection and table name
    private $connection;
    private $table="vol";
  
    // object properties
    public $vol_id = '';
    public $depart = '';
    public $arrivée = '';
    public $password = '';
    public $email = '';
    public $admin = '';
    public $error_message;
    public $response;

    // constructor with $db as database connection
    public function __construct($connection){
        $this->connection = $connection;
    }
    
    public function AllVol(){
        $query= "SELECT * FROM user";
        $prepare= $this->connection->prepare($query);
        if($prepare->execute()){
            return $prepare ->fetchAll();
        }else{
            return $prepare->errorInfo();
        }
    }
    public function get_name(){
        $query= "SELECT user.name FROM user WHERE user.email = :email";
        $prepare= $this->connection->prepare($query);
        $prepare->bindParam(':email', $this->email);
        if($prepare->execute()){
            return $prepare ->fetch();
        }else{
            return $prepare->errorInfo();
        }
    }
    public function AddVol(){
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