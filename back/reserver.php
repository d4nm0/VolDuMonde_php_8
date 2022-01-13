<?php
session_start();
print_r($_SESSION);
if(isset($_SESSION['user_id'])   and !empty($_SESSION['user_id'])){
    //import connection file
    include 'config.php';
    
    //create database connection
    $Database= new Database;
    $connection = $Database->create_connection();
    
    //import classes
    include '../class/user_vol.class.php';
    
    //create new instance of user
    $User_vol = new User_vol($connection);
    
    //get values passed by post
    
    $User_vol->user_id = $_SESSION['user_id'][0];
    $User_vol->vol_id = $_POST['vol_id'];

    $control = $User_vol->check_vol();
    
    //print_r($control);
    
    if($control['cnt'] ==0){
        $User_vol->insert_vol_user();
        header("location: ../front/index.php?msg=Vol réserver");
    }else{

        header("location: ../front/index.php?msg=déjà une réservation");
    }
        
    
}else{
    header("location: ../front/index.php?msg=Probleme lors de la réservation car pas connecter");
}