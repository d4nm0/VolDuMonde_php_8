<?php 
    session_start(); 
    //import classes
    include '../back/config.php';
    include '../class/vol.class.php';
            
    $Database   = new Database;
    $connection = $Database->create_connection();
    $Vol        = new Vol($connection);
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
                <?php if (isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Vos Reservations</a>
                        </li>
                    </ul>
                    <button type="button" class="btn btn-outline-dark" ><a href="../front/profil.php">Mon Profil</a></button>
                    <button type="button" class="btn btn-outline-dark" ><a href="../back/destroy.php">Se Déconnecter</a></button>
                <?php } else { ?>
                    </ul>
                    <button type="button" class="btn btn-outline-dark" ><a href="Login.php">Se Connecter</a></button>
                    <button type="button" class="btn btn-dark" ><a href="Register.php">S'inscrire</a></button>
                <?php } ?>
            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Départ</th>
                                <th>Heure de départ</th>
                                <th>Arrivée</th>
                                <th>Heure d'arrivée</th>
                                <th>Compagnie</th>
                                <th>Temps de vol</th>
                                <th>Aller/retour</th>
                                <th>Escale</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Vol->AllVol() as $vol) { ?>
                                <?php if (isset($_GET['action']) && $_GET['action'] === "edit" && $_GET['id'] === $vol['vol_id']) { ?> 
                                    <form action="../back/admin.php?action=edit_confirm&id=<?php echo $vol['vol_id']; ?>" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $vol['vol_id']; ?>"/>
                                        <td><?php echo $vol['id']; ?></td>
                                        <td><input class="form-control" type="text" name="depart" value="<?php echo $vol['depart']; ?>"/></td>
                                        <td><input class="form-control" type="datetime-local" name="heure_depart" value="<?php echo date('Y-m-d\TH:i', strtotime($vol['heure_depart'])); ?>" /></td>
                                        <td><input class="form-control" type="text" name="arrivee" value="<?php echo $vol['arrivée']; ?>" /></td>
                                        <td><input class="form-control" type="datetime-local" name="heure_arrivee" value="<?php echo date('Y-m-d\TH:i', strtotime($vol['heure_arrivée'])); ?>" /></td>
                                        <td><input class="form-control" type="text" name="compagnie" value="<?php echo $vol['compagnie']; ?>" /></td>
                                        <td><input class="form-control" type="text" name="temps_vol" value="<?php echo $vol['temps_vol']; ?>" /></td>
                                        <td>
                                            <select class="form-control" name="aller_retour">
                                                <option value="0" <?php if ($vol['aller_retour'] === "0") { ?> selected="selected"<?php } ?>>Non</option>
                                                <option value="1" <?php if ($vol['aller_retour'] === "1") { ?> selected="selected"<?php } ?>>Oui</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="escale">
                                                <option value="0" <?php if ($vol['escale'] === "0") { ?> selected="selected"<?php } ?>>Non</option>
                                                <option value="1" <?php if ($vol['escale'] === "1") { ?> selected="selected"<?php } ?>>Oui</option>
                                            </select>
                                        </td>
                                        <td><input class="btn btn-success" type="submit" value="Modifier" /></td>
                                    </form>
                                <?php } else { ?>
                                    <tr>
                                        <td><?php echo $vol['vol_id']; ?></td>
                                        <td><?php echo $vol['depart']; ?></td>
                                        <td><?php echo $vol['heure_depart']; ?></td>
                                        <td><?php echo $vol['arrivée']; ?></td>
                                        <td><?php echo $vol['heure_arrivée']; ?></td>
                                        <td><?php echo $vol['compagnie']; ?></td>
                                        <td><?php echo $vol['temps_vol']; ?></td>
                                        <td><?php if ($vol['aller_retour'] === "0") { ?>Non<?php } else { ?>Oui<?php } ?></td>
                                        <td><?php if ($vol['escale'] === "0") { ?>Non<?php } else { ?>Oui<?php } ?></td>
                                        <td>
                                            <a class="btn btn-warning" href="?action=edit&id=<?php echo $vol['vol_id']; ?>">Edit</a>
                                            <a class="btn btn-danger" href="../back/admin.php?action=delete&id=<?php echo $vol['vol_id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            <form action="../back/admin.php?action=create" method="POST">
                                <tr>
                                    <td></td>
                                    <td><input class="form-control" type="text" name="depart" /></td>
                                    <td><input class="form-control" type="datetime-local" name="heure_depart" /></td>
                                    <td><input class="form-control" type="text" name="arrivee" /></td>
                                    <td><input class="form-control" type="datetime-local" name="heure_arrivee" /></td>
                                    <td><input class="form-control" type="text" name="compagnie" /></td>
                                    <td><input class="form-control" type="text" name="temps_vol" /></td>
                                    <td>
                                        <select class="form-control" name="aller_retour">
                                            <option value="0">Non</option>
                                            <option value="1">Oui</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="escale">
                                            <option value="0">Non</option>
                                            <option value="1">Oui</option>
                                        </select>
                                    </td>
                                    <td><input class="btn btn-success" type="submit" value="Créer" /></td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>

