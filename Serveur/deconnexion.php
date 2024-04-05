<?php
// Initialisation de la session
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    // Détruire toutes les données de la session
    $_SESSION = array();

    // Détruire le cookie de session s'il existe
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Détruire la session
    session_destroy();
}

// Rediriger l'utilisateur vers la page de connexion
header("Location: ../index.php");
exit;
