<?php
// on importe le contenu du fichier "db.php"
include('db.php');
// on exécute la méthode de connexion à notre BDD
$db = connexionBase();

// on lance une requête pour chercher toutes les fiches d'artistes
$requete = $db->query("SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id;");
// on récupère tous les résultats trouvés dans une variable
$tableau = $requete->fetchAll(PDO::FETCH_ASSOC);


// on clôt la requête en BDD
$requete->closeCursor();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style##.css">
  <title>Document</title>
</head>

<body>
  <form action="script_artist_ajout.php" method="post">
    <!-- La class conteneur-fluid va occuper toute la largeur de la page disponible -->
    <nav class="navbar navbar-expand-lg bg-info">
      <div class="container-fluid">
        <a class="navbar-brand">Liste des disques</a>

       
      </div> 
      <a href="disc_new.php" class="btn btn-primary">Ajouter</a>
        <a href="login.php" class="btn btn-primary">Login</a>
        <a href="register.php" class="btn btn-primary">Register</a>
    </nav>
    <br><br>

    <div class="container">
      <div class="row">
        <?php foreach ($tableau as $disc) { ?>
          <div class="col-md-6">
            <div class="row col-md-12">
              <div class="col-md-6">
                <img class="w-100" src="assets/img/<?= $disc["disc_picture"] ?>"><br><br>
              </div>
              <div class="col-md-6">
                <br>
                <span class="fw-bold">Titre: </span>
                <?= $disc["disc_title"] . '<br>' ?>

                <span class="fw-bold">Name: </span>
                <?= $disc["artist_name"] . '<br>' ?>
                <span class="fw-bold">Year: </span>
                <?= $disc["disc_year"] . '<br>' ?>

                <span class="fw-bold">Label: </span>
                <?= $disc["disc_label"] . '<br>' ?>
                <span class="fw-bold">Genre: </span>
                <?= $disc["disc_genre"] . '<br>' ?>

                <br><br><br><br>

                <div>
                  <a href="disc_detail.php?id=<?= $disc["disc_id"] ?>" class="btn btn-primary">Détails</a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <script src="script.js"></script>
</body>

</html>