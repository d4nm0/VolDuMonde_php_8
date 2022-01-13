<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="index.css" rel="stylesheet" type="text/css" media="screen">
    </head>
    <body>
        <?php
        session_start();
        print_r($_SESSION);
        if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
            
            //import connection file
            include 'config.php';
            //create database connection
            $Database= new Database;
            $connection = $Database->create_connection();

            include 'user.class.php';
            $User = new User($connection);

            $all_user = $User->AllUser();
            ?>
            <h3>Ajouter un user</h3>
            <form method="POST" action="add_user.php">
                <input type="text" name="nom" class="" placeholder="nom" required>
                <input type="text" name="prenom" class="" placeholder="prenom" required>
                <input type="number" name="age" class="" required>
                <input type="text" name="email" class="" placeholder="email" required>
                <input type="submit" name="add_user" class="">
            </form>
            <h3>Modifier un user</h3>
            

            <?php
        }
        ?>
    </body>
</html>