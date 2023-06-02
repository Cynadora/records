<?php
// on importe le contenu du fichier "db.php"
include('db.php');
// on exécute la méthode de connexion à notre BDD
$db = connexionBase();

// Vérifie si la méthode de la requête est POST avant l'éxécution des instructions
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération des données :

    $id = (isset($_POST['id']) && $_POST['id'] != "") ? $_POST['id'] : Null;
    $title = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
    $artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;
    $year = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null;
    $genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
    $label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
    $price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;
    $picture = (isset($_POST['picture']) && $_POST['picture'] != "") ? $_POST['picture'] : Null;

    //////Vérifie si le paramètre "picture" existe dans la variable superglobale $_FILES et si sa valeur d'erreur ($_FILES["picture"]["error"]) est égale à 0
////La variable superglobale $_FILES est utilisée en PHP pour récupérer les fichiers téléchargés via un formulaire HTML.
/////Le code vérifie si un fichier a été téléchargé avec le nom de champ "picture" et s'il n'y a pas eu d'erreur lors du téléchargement (erreur 0).
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
        // Association des valeurs aux paramètres via bindValue() 
        $requete = $db->prepare("INSERT INTO disc (disc_title, artist_id, disc_year, disc_label, disc_genre, disc_price, disc_picture) VALUES (:title, :artist, :year, :label, :genre, :price, :picture)");

        $requete->bindValue(":title", $title);
        $requete->bindValue(":artist", $artist);
        $requete->bindValue(":year", $year);
        $requete->bindValue(":label", $genre);
        $requete->bindValue(":genre", $label);
        $requete->bindValue(":price", $price);
        $requete->bindValue(":picture", $picture);
        $requete->execute();
        echo "<p>L'ajout a bien été effectué !</p>";


        //code susceptible de générer une exception/  
    } catch (Exception $e) {
        //Message d'erreur avec le détail de l'erreur   
        echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
        //On termine le script en utilisant la fonction "die()" pour arrêter l'exécution 
        die("Fin du script (script_disc_ajout.php)");
    }

    /////////// Si OK: redirection vers la page disc_detail.php/ ou redirection vers la page des disques
    header("Location: index.php");
    exit;
}
?>