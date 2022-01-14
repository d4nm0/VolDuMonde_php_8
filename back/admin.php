<?php

session_start(); 
include 'config.php';
include '../class/vol.class.php';
        
$Database   = new Database;
$connection = $Database->create_connection();
$Vol        = new Vol($connection);

if (isset($_GET['action']) && !empty($_SESSION) && isset($_SESSION['admin'])) {
    if (!empty($_POST)) {
        if (isset($_POST['depart']) && isset($_POST['heure_depart']) && isset($_POST['arrivee'])
            && isset($_POST['heure_arrivee']) && isset($_POST['compagnie']) && isset($_POST['temps_vol']) 
            && isset($_POST['aller_retour']) && isset($_POST['escale']) && isset($_POST['place'])) {
            $Vol->setInfos(
                $_POST['depart'], 
                $_POST['heure_depart'], 
                $_POST['arrivee'], 
                $_POST['heure_arrivee'],
                $_POST['compagnie'], 
                $_POST['temps_vol'], 
                $_POST['aller_retour'], 
                $_POST['escale'],
                $_POST['place'],
                isset($_POST['id']) ? $_POST['id'] : null
            );
        }
    }

    switch ($_GET['action']) {
      case 'create':
        $Vol->createVol();
        
        break;
      case 'edit_confirm':
        $Vol->editVol();

        break;
      case 'delete':
        if (isset($_GET['id'])) {
            $Vol->deleteVol($_GET['id']);
        }
        
        break;
    }
}

header('location:../front/admin.php');