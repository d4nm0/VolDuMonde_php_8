<?php
session_start();
if(         isset($_POST['name'])   and !empty($_POST['name'])
        and isset($_POST['password'])   and !empty($_POST['password'])
        and isset($_POST['email'])   and !empty($_POST['email'])){
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
    $User->email = $_POST['email'];
    $User->AddUser();
        
    $msg .="User add";
    
    
    header("location: ../front/index.php?msg=".$msg."");
    
}else{
    $msg .="pas réussi à récuperer les champs";
    header("location: ../front/index.php?msg=".$msg."");
}