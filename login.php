<?php

// on importe le contenu du fichier "db.php"
include('db.php');
// on exécute la méthode de connexion à notre BDD
$db = connexionBase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = (isset($_POST['username']) && $_POST['username'] != "") ? $_POST['username'] : null;
    $password = (isset($_POST['password']) && $_POST['password'] != "") ? $_POST['password'] : null;

    // Vérification de connexion 
    if ($username === "admin" && $password === "password") {
        // Connexion réussie, redirection
        header("Location: index.php");
        exit;
    } else {
        // Identifiants incorrects, Message d'erreur
        $message = "Identifiants incorrects";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>

<body>
    <div class="container" style="margin-top: 30px;">

        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="login-form" method="post" action="" role="form">
                        <legend>Login</legend>

                        <?php if (isset($message)) { ?>
                            <p class="alert alert-danger text-center">
                                <?php echo $message; ?>
                            </p>
                        <?php } ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input type="text" name="username" placeholder="Entrer votre nom" required
                                class="form-control" />
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" name="password" placeholder="Entrer votre mot de passe" required
                                class="form-control" />
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Connexion" class="btn btn-warning btn-block" />

                            <a href="index.php" class="btn btn-success">Retour</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>