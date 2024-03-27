<?php
// Initialisation de la session
session_start();

// Détruire toutes les données de la session
$_SESSION = array();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion
header("Location: index.php");
exit;
?>
