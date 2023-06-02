<?php
// on importe le contenu du fichier "db.php" SUR TOUTES LES PAGES
include('db.php');
// On récupère l'ID passé en paramètre :
$id = $_GET['id'];
// on exécute la méthode de connexion à notre BDD
$db = connexionBase();

// On crée une requête préparée avec condition de recherche :
$requete = $db->prepare("SELECT * FROM disc JOIN artist ON artist.artist_id = disc.artist_id WHERE disc.disc_id=?");
// on ajoute l'ID du disque passé dans l'URL en paramètre et on exécute :
$requete->execute(array($id));

// Méthode avec FETCH_ASSOC (fetch_assoc = récupérer dans un tableau associatif)
// Méthode avec FETCH_OBJ (fetch_obj = récupérer dans un objet)
$disc = $requete->fetch(PDO::FETCH_ASSOC);
// on clôt la requête en BDD
$requete->closeCursor();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Formulaire détails</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-info">
            <a class="navbar-brand">Details</a>
        </nav>
        <div class="container-fluid mt-3">
            <form>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" value="<?php echo $disc['disc_title']; ?>"
                        disabled>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="artist">Artist</label>
                        <input type="text" class="form-control" id="artist" value="<?php echo $disc['artist_name']; ?>"
                        disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" id="inputYear" value="<?php echo $disc['disc_year']; ?>"
                            disabled>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="genre">Genre</label>
                        <input type="text" class="form-control" id="genre" value="<?php echo $disc['disc_genre']; ?>"
                        disabled>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="label">Label</label>
                        <input type="text" class="form-control" id="label" value="<?php echo $disc['disc_label']; ?>"
                        disabled>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="price-input">Price</label>
                        <input type="number" class="form-control" id="price-input" name="price" step="0.01" min="0"
                            value="<?php echo $disc['disc_price']; ?>" disabled>
                    </div>
                    </label>
                </div>
                <div>
                    <h6>Picture</h6>
                    <img class="img w-25" src="assets/img/<?php echo $disc['disc_picture'] ?>" alt="picture"
                        title="Picture">
                </div>
                <br>

                <a href="disc_form.php?id=<?= $disc['disc_id'] ?>" class="btn btn-warning">Modification</a>

                <a href="script_disc_delete.php?id=<?= $disc["disc_id"] ?>"
                    onclick="return confirm('Etes-vous sûr de vouloir supprimer ce disque ?');"
                    class="btn btn-secondary">Suppression</a>

                <a href="index.php" class="btn btn-info">Retour</a>
        </div>
    </div>
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>