<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Vol Du Monde</title>
</head>
<body>
    <?php include_once 'header.php'; ?>
      <div class="container">
        <div class="row">
          <div class="col">
            <h1>Mes réservations : </h1>
          </div>
        </div>
      </div>
      <br>
      <br>
      <?php 
        //import connection file
        include '../back/config.php';
                
        //create database connection
        $Database= new Database;
        $connection = $Database->create_connection();
        
        //import classes
        include '../class/vol.class.php';
        include '../class/user_vol.class.php';
        
        //create new instance of user
        $Vol = new Vol($connection);
        $User_vol = new User_vol($connection);
        
        $User_vol->user_id=$_SESSION['user_id'][0];
        $vol_user = $User_vol->select_vol_by_user_id();
        ?>
        <div class="container">
            <div class="row">
        <?php

        foreach($vol_user as $row){
            ?>
            <div class="col-lg-4" >
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['depart']; echo ' -> '; echo $row['arrivée'];?></h5>
                <p class="card-text">Heure départ : <?php echo $row['heure_depart'];?><br> <?php echo ' Heure arrivée : '; echo $row['heure_arrivée'];?></p>
                <p class="card-text">Compagnie : <?php echo $row['compagnie'];?></p>
                <p class="card-text">Temps de vol : <?php echo $row['temps_vol'];?></p>
                <?php
                if($row['aller_retour'] == 1){
                  $aller_retour = "Oui";
                }else{
                  $aller_retour = "Non";
                }
                ?>
                <p class="card-text">Aller et retour : <?php echo $aller_retour;?></p>
                <p class="card-text">Nombre d'escale : <?php echo $row['escale'];?></p>
                <form action="../back/annuler_res.php" method="POST">
                  <input type="hidden" name="vol_id" id="vol_id" value="<?php echo $row['vol_id']?>"/>
                  <button type="submit" value="Reserver" class="btn btn-primary"><span>Annuler la réservation</span></button>
                </form>
              </div>
            </div>
          </div>
        <?php
        }
        
      ?>
      </div>
        
    </div>
</body>