<?php
//On importe le contenu du fichier "db.php"
include('db.php');
// On exécute la méthode de connexion à notre BDD
$db = connexionBase();

// Récupération des données :
$id = (isset($_POST['id']) && $_POST['id'] != "") ? $_POST['id'] : Null;
$title = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
$artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;
$year = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null;
$genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
$label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
$price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;
$picture = (isset($_POST['picture']) && $_POST['picture'] != "") ? $_POST['picture'] : Null;

// En cas d'erreur, on renvoie vers le formulaire
if ($title == Null || $artist == Null || $year == Null || $genre == Null || $label == Null || $price == Null) {
    header("Location: disc_form.php?id=" . $id);

}

// Gestion de l'upload de l'image
$filename = null;
if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
    $allowedExtensions = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

    //Récupère les infos du fichier téléchargé dans les variables '$filename', '$filetype' et '$filesize'
    //$filename contient le nom du fichier tel qu'il était lorsqu'il a été téléchargé   
    $filename = $_FILES["picture"]["name"];
    //$filetype contient le type MIME du fichier téléchargé/
    $filetype = $_FILES["picture"]["type"];
    //$filesize contient la taille du fichier en octets
    $filesize = $_FILES["picture"]["size"];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!array_key_exists($ext, $allowedExtensions)) {
        die("Erreur : Veuillez sélectionner un format de fichier valide.");
    }

    $maxsize = 5 * 1024 * 1024;
    if ($filesize > $maxsize) {
        die("Erreur: La taille du fichier dépasse la limite autorisée.");
    }

    if (in_array($filetype, $allowedExtensions)) {
        $picture = $filename;
        $targetPath = "./assets/img/" . $filename;
        if (file_exists($targetPath)) {
            echo $filename . " Ce fichier existe déjà.";
        } else {
            move_uploaded_file($_FILES["picture"]["tmp_name"], $targetPath);
            echo "Bravo votre fichier a été téléchargé avec succès.";
        }
    } else {
        echo "Erreur: Problème lors du téléchargement du fichier. Veuillez réessayer.";
    }
} else {
    echo "Erreur: " . $_FILES["picture"]["error"];
}

try {
    // Construction de la requête UPDATE sans injection SQL :
    ////////$requete = $db->prepare("UPDATE disc SET disc_title=:title,artist_id=:artist,disc_year=:year,disc_genre=:genre,disc_label=:label,disc_price=:price,disc_picture=:picture WHERE disc.disc_id=:id");
    //////////////// Association des valeurs aux paramètres via bindValue() 
    $requete = $db->prepare("UPDATE disc SET disc_title = :title, artist_id = :artist, disc_year = :year, disc_genre = :genre, disc_label = :label, disc_price = :price, disc_picture = :picture WHERE disc.disc_id = :id");

    // Construction de la requête UPDATE sans injection SQL :
    $requete->bindValue(":id", $id);
    $requete->bindValue(":title", $title);
    $requete->bindValue(":artist", $artist);
    $requete->bindValue(":year", $year);
    $requete->bindValue(":label", $genre);
    $requete->bindValue(":genre", $label);
    $requete->bindValue(":price", $price);
    $requete->bindValue(":picture", $picture);
    $requete->execute();
    echo "<p>La modification a bien été effectuée !</p>";


    //code susceptible de générer une exception/
} catch (Exception $e) {
    //Message d'erreur avec le détail de l'erreur
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    //On termine le script en utilisant la fonction "die()" pour arrêter l'exécution
    die("fin du script (index.php");
}

//Si OK: redirection vers la page disc_detail.php
header("Location: disc_detail.php?id=" . $id);
//fermeture du script
exit;

?>