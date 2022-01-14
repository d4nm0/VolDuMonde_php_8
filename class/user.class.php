<?php

class User {
    // database connection and table name
    private $connection;
    private $table="user";
    public $error_message;
    public $response;
  
    // object properties
    private $user_id  = '';
    private $name     = '';
    private $password = '';
    private $email    = '';
    private $admin    = '';

    // constructor with $db as database connection
    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    
    public function check_connection(){
        
        $query = "SELECT COUNT(user_id) as cnt FROM user WHERE name = :name AND password = sha1(:password)";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':name', $this->name);
        $prepare->bindParam(':password', $this->password);

        if ($prepare->execute()) {
            return $prepare->fetch();
        } else{
            $this->error_message = $prepare->errorInfo();
            return false;
        }
    }

    public function getId()
    {
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

    public function AllUser()
    {
        $query= "SELECT * FROM user";
        $prepare= $this->connection->prepare($query);
        if($prepare->execute()){
            return $prepare ->fetchAll();
        }else{
            return $prepare->errorInfo();
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function setAdmin(string $admin)
    {
        $this->admin = $admin;

        return $this;
    }
}