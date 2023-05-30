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
  <title>Document</title>

<body>
  <!-- La class conteneur-fluid va occuper toute la largeur de la page disponible -->
  <div class="container-fluid">

    <nav class="navbar navbar-expand-lg bg-info">
      <div class="container-fluid">
        <a class="navbar-brand">Ajouter un vinyle</a>
    </nav>


    <br>
    <form action="script_disc_ajout.php" id="formulaire" method="post" enctype="multipart/form-data">

      <!--Input Title-->
      <div class="mb-3 row">
        <label class="col-sm-12 col-form-label" for="title">Title</label>
        <div class="col-sm-12">
          <input class="form-control" type="text" id="inputTitle" placeholder="Enter title ">
        </div>
      </div>
      <br>

      <!--Liste déroulante / Sélection de l'artiste du disque-->
      <label class="col-sm-12 col-form-label" for="title">Artist</label>
      <div class="input-group">
        <select class="form-select" id="inputGroupSelect">
          <option selected>Choisir un artiste</option>
          <?php
          foreach ($artist as $unArtiste) { ?>
            <option value="<?= $unArtiste['artist_id'] ?>"><?= $unArtiste['artist_name'] ?></option>
            <?php
          }
          ?>
        </select>
        <label class="input-group-text" for="inputGroupSelect"></label>
      </div>
      <br>

      <!--Input Année-->
      <div class="mb-3 row">
        <label class="col-sm-12 col-form-label" for="year">Year</label>
        <div class="col-sm-12">
          <input class="form-control" type="text" id="inputYear" placeholder="Enter year ">
        </div>
      </div>
      <br>

      <!--Input Genre-->
      <div class="mb-3 row">
        <label class="col-sm-12 col-form-label" for="genre">Genre</label>
        <div class="col-sm-12">
          <input class="form-control" type="text" id="inputTitre" placeholder="Enter genre (Rock, Pop, Prog...) ">
        </div>
      </div>
      <br>

      <!--Input Label-->
      <div class="mb-3 row">
        <label class="col-sm-12 col-form-label" for="label">Label</label>
        <div class="col-sm-12">
          <input class="form-control" type="text" id="inputLabel"
            placeholder="Enter label (EMI, Warner, PolyGram, Univers sale...)">

        </div>
      </div>
      <br>

      <!--Input Prix-->
      <div class="form-group">
        <label for="price-input">Price</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <!-- <span class="input-group-text">$</span>-->
          </div>
          <input type="number" class="form-control" id="price-input" name="price" step="0.01" min="0">
        </div>
      </div>
      <br>

      <!--Input Picture aucun fichier n'a été sélectionné-->
      <div class="form-group">
        <label for="picture-input">Picture</label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="picture-input" name="picture">

          <label class="custom-file-label" for="picture-input"></label>
        </div>
      </div>
      <br>
    <!-- Bouton envoyer et annuler -->
      <button type="submit" class="btn btn-warning">Ajouter</button>
      <a href="index.php" class="btn btn-primary">Retour</a>

      
    </form>

    <br> <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"></script>
</body>

</html>