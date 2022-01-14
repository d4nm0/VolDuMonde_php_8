<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="Register.js"></script>
    <title>Vol Du Monde - Login</title>
</head>
<body>
    <?php include_once 'header.php'; ?>
    <div class="container">
      <div class="row">
        <div class="col d-flex justify-content-center">
          <div class="card">
            <div class="card-body">
              <form action="../back/connection_verif.php" method="POST">
                <legend>Se connecter :</legend>
                <div class="mb-3">
                  <span class="input"></span>
                  <input class="form-control" type="email" name="email" placeholder="Email address" required />
                </div>
                <div class="mb-3">
                  <span id="passwordMeter"></span>
                  <input class="form-control" type="password" name="password" id="password" placeholder="Password" title="Password min 8 characters. At least one UPPERCASE and one lowercase letter" required pattern="(?=^.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$"/>
                </div>
                <button type="submit" value="Sign Up" title="Submit form" class="icon-arrow-right btn"><span>Connexion</span></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>





