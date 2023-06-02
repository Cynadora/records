<?php
if (!(isset($_GET['id'])) || intval($_GET['id']) <= 0)
    goto TrtRedirection;
// on importe le contenu du fichier "db.php" si la vérification est ok
require "db.php";
// On récupère l'ID passé en paramètre :
$db = connexionBase();
try {
    // Construction de la requête DELETE sans injection SQL :
    $requete = $db->prepare("DELETE FROM disc WHERE disc_id = ?");
    // on ajoute l'ID du disque passé dans l'url en paramètre et on exécute: 
    $requete->execute(array($_GET["id"]));
    $requete->execute();
    // on clôt la requête en BDD
    $requete->closeCursor();
} catch (Exception $e) {
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_modif.php)");
}

// Si OK: redirection vers la page artists.php
TrtRedirection:
header("Location: index.php");
exit;

?>