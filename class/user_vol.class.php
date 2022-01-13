<?php

class User_vol {
    // database connection and table name
    private $connection;
    private $table="user_vol";
  
    // object properties
    public $user_vol_id = '';
    public $user_id = '';
    public $vol_id = '';
    public $error_message;
    public $response;

    // constructor with $db as database connection
    public function __construct($connection){
        $this->connection = $connection;
    }

    public function insert_vol_user(){
        $query = "INSERT INTO `user_vol` (`user_id`, `vol_id`) VALUES (:user_id , :vol_id);";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':user_id', $this->user_id);
        $prepare->bindParam(':vol_id', $this->vol_id);
        if($prepare->execute()){
            $this->user_vol_id = $this->connection->lastInsertId();
            return true;
        }
        else{
            $this->error_message = $prepare->errorInfo();
            print_r($this->error_message);
            return false;
        }
    }
    public function check_vol(){
        
        $query = "SELECT COUNT(user_vol_id) as cnt FROM user_vol WHERE user_id = :user_id AND vol_id = :vol_id";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':user_id', $this->user_id);
        $prepare->bindParam(':vol_id', $this->vol_id);
        if($prepare->execute()){
            return $prepare->fetch();
        }
        else{
            $this->error_message = $prepare->errorInfo();
            return false;
        }
    }
    public function select_vol_by_user_id(){
        
        $query = "SELECT vol_id FROM user_vol WHERE user_id = :user_id";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':user_id', $this->user_id);
        if($prepare->execute()){
            return $prepare->fetchAll();
        }
        else{
            $this->error_message = $prepare->errorInfo();
            return false;
        }
    }
    public function delete_user_vol(){
        $query = "DELETE FROM `user_vol` WHERE user_id = :user_id AND vol_id = :vol_id";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':user_id', $this->user_id);
        $prepare->bindParam(':vol_id', $this->vol_id);
        $prepare->execute();
        return $prepare->rowCount();
    }
}
?>