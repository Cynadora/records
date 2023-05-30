<?php
// on importe le contenu du fichier "db.php"
include('db.php');
// on exécute la méthode de connexion à notre BDD
$db = connexionBase();




// Préparez la requête SQL avec des paramètres
$stmt = $pdo->prepare("INSERT INTO users (title, artist, year, genre, label) VALUES (:title, :artist, :year, :genre, :label)");

// Liez les valeurs des paramètres :title et :artist avec la méthode 'bindValue()'/ 
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':artist', $artist, PDO::PARAM_STR);

// Exécutez la requête
$stmt->execute();


?>