<?php
// Vérifie si l'ID de l'utilisateur est défini dans la requête POST de manière sécurisée
$userId = filter_input(INPUT_POST, 'userId', FILTER_VALIDATE_INT);
if ($userId !== null && $userId !== false) {
    // Connexion à la base de données
    require_once('bdd.php');

    // Prépare et exécute la requête SQL pour mettre à jour le statut valide de l'utilisateur de manière sécurisée
    $stmt = $bdd->prepare("UPDATE utilisateur SET valide = 1 WHERE id_utilisateur = :userId");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();

    // Vérifie si la requête a réussi
    if ($stmt->rowCount() > 0) {
        // Retourne un code de succès (200)
        http_response_code(200);
        echo "L'utilisateur a été ajouté avec succès.";
        header("Location: ../Administration/dashboard_utilisateur.php?success=true");
    } else {
        // Retourne un code d'erreur (500) en cas d'échec de la requête
        http_response_code(500);
        echo "Une erreur s'est produite lors de l'ajout de l'utilisateur.";
        header("Location: ../Administration/dashboard_utilisateur.php?success=false");
    }
} else {
    // Retourne un code d'erreur (400) si l'ID de l'utilisateur n'est pas défini dans la requête POST ou s'il est invalide
    http_response_code(400);
    echo "L'ID de l'utilisateur n'est pas valide ou non spécifié.";
    header("Location: ../Administration/dashboard_utilisateur.php?success=false");
}
