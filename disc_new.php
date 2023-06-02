<?php
// on importe le contenu du fichier "db.php" SUR TOUTES LES PAGES
include('db.php');
// on exécute la méthode de connexion à notre BDD
$db = connexionBase();

// on lance une requête pour chercher toutes les fiches d'artistes
$requete = $db->query("SELECT * FROM artist");
$requete->execute();
// on récupère tous les résultats dans le tableau trouvés dans une variable   
$artist = $requete->fetchAll(PDO::FETCH_ASSOC);
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
  <title>Disc_new</title>

<body>
  <!-- La class conteneur-fluid va occuper toute la largeur de la page disponible -->
  <div class="container-fluid">

    <nav class="navbar navbar-expand-lg bg-info">
      <div class="container-fluid">
        <a class="navbar-brand">Ajouter un vinyle</a>
    </nav>
    <!--Grâce à enctype, le navigateur du visiteur sait qu'il s'apprête à envoyer des fichiers.-->
    <form action="script_disc_ajout.php" id="formulaire" method="post" enctype="multipart/form-data">
      <!--Input Title-->
      <div class="mb-3 row">
        <label class="col-sm-12 col-form-label" for="title">Title</label>
        <div class="col-sm-12">
          <input class="form-control" type="text" name="title" placeholder="Enter title">
        </div>
      </div>
      <!--Liste déroulante / Sélection de l'artiste du disque-->
      <label class="col-sm-12 col-form-label">Artist</label>
      <div class="input-group">
        <select class="form-select" name="artist">
          <option selected>Choisir un artiste</option>
          <?php
          foreach ($artist as $unArtiste) { ?>
            <option value="<?= $unArtiste['artist_id'] ?>"><?= $unArtiste['artist_name'] ?></option>
            <?php
          }
          ?>
        </select>
        <label class="input-group-text"></label>
      </div>
      <!--Input Année-->
      <div class="mb-3 row">
        <label class="col-sm-12 col-form-label">Year</label>
        <div class="col-sm-12">
          <input class="form-control" type="text" name="year" placeholder="Enter year ">
        </div>
      </div>
      <!--Input Genre-->
      <div class="mb-3 row">
        <label class="col-sm-12 col-form-label">Genre</label>
        <div class="col-sm-12">
          <input class="form-control" type="text" name="genre" placeholder="Enter genre (Rock, Pop, Prog...) ">
        </div>
      </div>
      <!--Input Label-->
      <div class="mb-3 row">
        <label class="col-sm-12 col-form-label">Label</label>
        <div class="col-sm-12">
          <input class="form-control" type="text" name="label"
            placeholder="Enter label (EMI, Warner, PolyGram, Univers sale...)">
        </div>
      </div>
      <!--Input Prix-->
      <div class="form-group">
        <label for="price-input">Price</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <!-- <span class="input-group-text">$</span>-->
          </div>
          <input type="number" class="form-control" name="price">
        </div>
      </div>
      <!--Input Picture aucun fichier n'a été sélectionné-->
      <div class="form-group">
        <label>Picture</label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="picture">
        </div>
      </div>
      <!-- Bouton envoyer et annuler -->
      <div class="py-3">
        <button type="submit" class="btn btn-warning">Ajouter</button>
        <a href="index.php" class="btn btn-primary">Retour</a>
      </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"></script>
</body>

</html>