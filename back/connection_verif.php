<?php
session_start();

if (isset($_POST['email']) and !empty($_POST['email'])
    and isset($_POST['password']) and !empty($_POST['password'])) {
    //import connection file
    include 'config.php';
    
    //create database connection
    $Database   = new Database;
    $connection = $Database->create_connection();
    
    //import classes
    include '../class/user.class.php';
    
    //create new instance of user
    $User = new User($connection);
    
    //get values passed by post
    
    $User->email        = $_POST['email'];
    $User->password     = $_POST['password'];
    $control_connection = $User->check_connection();
    
    if ($control_connection['cnt'] == 0) {
        session_destroy();
        header("location: ../front/index.php?&msg=user pas trouvé");
    } else {
        $_SESSION['name']    = $User->getName();
        $_SESSION['email']   = $_POST['email'];
        $_SESSION['user_id'] = $User->getId();
        $_SESSION['admin']   = $User->getAdmin();
        header("location: ../front/index.php");
    }
} else {
    header("location: ../front/index.php?msg=champs introuvable");
}