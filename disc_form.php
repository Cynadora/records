<?php
// On charge l'enregistrement correspondant à l'ID passé en paramètre/on importe le contenu du fichier "db.php"
include "db.php";
// on exécute la méthode de connexion à notre BDD
$db = connexionBase();

// On récupère l'ID passé en paramètre :
$id = (isset($_GET['id']) && $_GET['id'] != "") ? $_GET['id'] : Null;

// On crée une requête préparée avec condition de recherche :
//$requete = $db->prepare("SELECT * FROM artist WHERE artist_id=?");
$requete = $db->prepare("SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id WHERE disc_id=?");
// on ajoute l'ID du disque passé dans l'URL en paramètre et on exécute :
//$requete->execute(array($_GET["id"]));
$requete->execute(array($id));
//on récupère le  (et seul) résultat :
$disc = $requete->fetch(PDO::FETCH_ASSOC);
// on clôt la requête en BDD
$requete->closeCursor();

$requete2 = $db->query("SELECT * FROM artist");
$requete2->execute();
// on récupère tous les résultats dans le tableau trouvés dans une variable   
$artists = $requete2->fetchAll(PDO::FETCH_ASSOC);
// on clôt la requête en BDD  
$requete2->closeCursor();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Form Example</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>

<body>
  <div class="container-fluid">

    <nav class="navbar navbar-expand-lg bg-info">
      <div class="container-fluid">
        <a class="navbar-brand">Modifier un vinyle</a>
    </nav>
    <br>


    <form action="script_disc_modif.php" id="formulaire" method="post" enctype="multipart/form-data">
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
      <select class="form-select" aria-label="Default select example">
        <option selected>Choisir un artiste</option>
        <?php
        foreach ($artists as $unArtiste) { ?>
          <option value="<?= $unArtiste['artist_id'] ?>"><?= $unArtiste['artist_name'] ?></option>
          <?php
        }
        ?>
      </select>


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
          <input type="number" class="form-control" id="price-input" name="price" step="0.01" min="0" required>
        </div>
      </div>
      <br>

  </div>
  <div>
    <div>
      <h6>Picture</h6>
      <button type="button" class="btn btn-primary">Choisir un fichier</button> Aucun fichier choisi
    </div>
    <div>
      <br>
      <img class="img w-25" src="assets/img/<?php echo $disc['disc_picture'] ?>" alt="picture" title="Picture">
    </div>
    <div>
      <br>
      <button type="submit" class="btn btn-primary">Modifier</button>
      <a href="index.php" class="btn btn-warning">Retour</a>
    </div>


  </div>
  <br>
  </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>