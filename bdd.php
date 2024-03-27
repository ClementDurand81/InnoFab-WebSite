<?php
// Paramètres de connexion à la base de données
$host = '127.0.0.1';
$dbname = 'innofab';
$username = 'root';
$password = ''; 

try {
    // Connexion à la base de données avec PDO
    $bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configuration des options de PDO pour afficher les erreurs SQL
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // En cas d'erreur de connexion, affichage de l'erreur
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}
?>
