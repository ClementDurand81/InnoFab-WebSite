<?php
// Vérifie si l'utilisateur est connecté
session_start();
require_once('bdd.php'); // Assurez-vous de remplacer 'bdd.php' avec le chemin correct vers votre fichier de connexion

if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    
    // Requête pour supprimer le compte de l'utilisateur
    $stmt_delete_user = $bdd->prepare("DELETE FROM utilisateur WHERE id_utilisateur = :user_id");
    $stmt_delete_user->execute(array(':user_id' => $userId));
    
    // Déconnexion de l'utilisateur
    session_unset();
    session_destroy();
    
    // Redirection vers une page de confirmation ou une autre page après la suppression du compte
    header("Location: /index.php");
    exit();
} else {
    // Redirection vers une page d'erreur si l'utilisateur n'est pas connecté
    header("Location: erreur.php");
    exit();
}
?>