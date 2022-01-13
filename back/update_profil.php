<?php
session_start();
//print_r($_POST);
if(         isset($_POST['update_user'])   and !empty($_POST['update_user'])){
    //import connection file
    include 'config.php';
    
    //create database connection
    $Database= new Database;
    $connection = $Database->create_connection();
    
    //import classes
    include '../class/user.class.php';
    
    //create new instance of user
    $User = new User($connection);
    
    $User->user_id = $_SESSION['user_id'][0];
    $info = $User->get_info();
    //print_r($info);
    //get values passed by post
    if(!empty($_POST['name'])){
        $User->name = $_POST['name'];
    }else{
        $User->name = $info['name'];
    }
    if(!empty($_POST['email'])){
        $User->email = $_POST['email'];
    }else{
        $User->email = $info['email'];
    }
    if(!empty($_POST['password'])){
        $User->password = $_POST['password'];
    }
    $User->update_user();
        
    header("location: ../front/index.php?msg=user modifié");
    
}else{
    header("location: ../front/index.php?msg=problème");
}