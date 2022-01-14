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
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function insert_vol_user()
    {
        $query   = "INSERT INTO `user_vol` (`user_id`, `vol_id`) VALUES (:user_id , :vol_id);";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':user_id', $this->user_id);
        $prepare->bindParam(':vol_id', $this->vol_id);

        if ($prepare->execute()) {
            $this->user_vol_id = $this->connection->lastInsertId();
        } else {
            $this->error_message = $prepare->errorInfo();

            return false;
        }

        $query   = "UPDATE `vol` SET `place_dispo`=`place_dispo`-1 WHERE vol_id=:vol_id;";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':vol_id', $this->vol_id);

        if ($prepare->execute()) {
            return true;
        } else {
            $this->error_message = $prepare->errorInfo();

            return false;
        }
    }

    public function check_vol()
    {
        $query   = "SELECT COUNT(user_vol_id) as cnt FROM user_vol WHERE user_id = :user_id AND vol_id = :vol_id";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':user_id', $this->user_id);
        $prepare->bindParam(':vol_id', $this->vol_id);
        
        if ($prepare->execute()) {
            return $prepare->fetch();
        } else {
            $this->error_message = $prepare->errorInfo();

            return false;
        }
    }

    public function getAllReservations()
    {
        $query   = "SELECT * FROM user_vol _uv INNER JOIN vol _v ON _uv.vol_id = _v.vol_id INNER JOIN user _u ON _uv.user_id = _u.user_id";
        $prepare = $this->connection->prepare($query);

        if ($prepare->execute()) {
            return $prepare->fetchAll();
        } else {
            $this->error_message = $prepare->errorInfo();

            return false;
        }
    }

    public function select_vol_by_user_id()
    {
        $query   = "SELECT * FROM user_vol _uv INNER JOIN vol _v ON _uv.vol_id = _v.vol_id WHERE user_id = :user_id";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':user_id', $this->user_id);

        if ($prepare->execute()) {
            return $prepare->fetchAll();
        } else {
            $this->error_message = $prepare->errorInfo();

            return false;
        }
    }

    public function delete_user_vol()
    {
        $query   = "DELETE FROM `user_vol` WHERE user_id = :user_id AND vol_id = :vol_id";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':user_id', $this->user_id);
        $prepare->bindParam(':vol_id', $this->vol_id);
        $prepare->execute();
        $count   = $prepare->rowCount();

        $query   = "UPDATE `vol` SET `place_dispo`=`place_dispo`+1 WHERE vol_id=:vol_id;";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':vol_id', $this->vol_id);

        if ($prepare->execute()) {
            return $count;
        } else {
            $this->error_message = $prepare->errorInfo();

            return false;
        }
    }
}