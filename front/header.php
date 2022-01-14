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
                    <a class="nav-link" href="../front/reservations.php">Vos Reservations</a>
                </li>
            </ul>
            <?php if (isset($_SESSION['admin']) and !empty($_SESSION['admin'])) { ?>
                <a href="../front/admin.php" class="btn btn-outline-dark">Admin</a>
            <?php } ?>
            <a href="../front/profil.php" class="btn btn-outline-dark">Mon Profil</a>
            <a href="../back/destroy.php" class="btn btn-outline-dark">Se Déconnecter</a>
        <?php } else { ?>
            </ul>
            <a href="Login.php" class="btn btn-outline-dark">Se Connecter</a>
            <a href="Register.php" class="btn btn-dark">S'inscrire</a>
        <?php } ?>
    </div>
</nav>