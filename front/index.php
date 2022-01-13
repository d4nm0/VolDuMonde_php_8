<?php 
session_start();
//print_r($_SESSION);
?>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Vol Du Monde</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php
            if(isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])){
              ?>
                <li class="nav-item">
                  <a class="nav-link" href="#">Vos Reservations</a>
                </li>
              </ul>
              <button type="button" class="btn btn-outline-dark" ><a href="../front/profil.php">Mon Profil</a></button>
              <button type="button" class="btn btn-outline-dark" ><a href="../back/destroy.php">Se Déconnecter</a></button>
              <?php
            }else{
              ?>
              </ul>
              <button type="button" class="btn btn-outline-dark" ><a href="Login.php">Se Connecter</a></button>
              <button type="button" class="btn btn-dark" ><a href="Register.php">S'inscrire</a></button>
              <?php
            }
            ?>
            
          
          
        </div>
      </nav>
      <div class="container">
          <div class="row">
      <?php
      //import connection file
      include '../back/config.php';
            
      //create database connection
      $Database= new Database;
      $connection = $Database->create_connection();
      
      //import classes
      include '../class/vol.class.php';
      
      //create new instance of user
      $Vol = new Vol($connection);
      
      //get values passed by post
      
      $all_info = $Vol->AllVol();
      //print_r($all_info);
      foreach($all_info as $row){
        ?>
        

          <div class="col-lg-4" >
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['depart']; echo ' -> '; echo $row['arrivée'];?></h5>
                <p class="card-text">Heure départ : <?php echo $row['heure_depart'];?><br> <?php echo ' Heure arrivée : '; echo $row['heure_arrivée'];?></p>
                <p class="card-text">Compagnie : <?php echo $row['compagnie'];?></p>
                <p class="card-text">Temps de vol : <?php echo $row['temps_vol'];?></p>
                <?php
                if($row['compagnie'] == 1){
                  $aller_retour = "Oui";
                }else{
                  $aller_retour = "Non";
                }
                ?>
                <p class="card-text">Aller et retour : <?php echo $aller_retour;?></p>
                <p class="card-text">Nombre d'escale : <?php echo $row['escale'];?></p>
                <a href="#" class="btn btn-primary">Reserver</a>
              </div>
            </div>
          </div>
        
    <?php
      }
      ?>
    </div>
    </div>
</body>
</html>