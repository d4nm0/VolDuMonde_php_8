<?php
session_start();

if(         isset($_POST['name'])   and !empty($_POST['name'])
        and isset($_POST['password'])   and !empty($_POST['password'])){
    //import connection file
    include 'config.php';
    
    //create database connection
    $Database= new Database;
    $connection = $Database->create_connection();
    
    //import classes
    include '../class/user.class.php';
    
    //create new instance of user
    $User = new User($connection);
    
    //get values passed by post
    
    $User->name = $_POST['name'];
    $User->password = $_POST['password'];
    
    
    $control_connection = $User->check_connection();
    
    //print_r($control_connection);
    
    if($control_connection['cnt'] ==0){
        session_destroy();
        header("location: index.php?&msg=user pas trouvé");
        
    }else{       
        $User->id=$User->getId();

        $_SESSION['nom']= $_POST['nom'];
        $_SESSION['prenom']= $_POST['prenom'];
        $_SESSION['id']= $User->id;
        header("location: index.php");
    }
}else{
    header("location: index.php");
}