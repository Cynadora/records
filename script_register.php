<?php
// on importe le contenu du fichier "db.php" SUR TOUTES LES PAGES
include('db.php');
// on exécute la méthode de connexion à notre BDD
$db = connexionBase();

// Vérifie si la méthode de la requête est POST avant l'éxécution des instructions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
?>