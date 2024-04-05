<?php
// Connexion à la base de données
require_once('bdd.php');

// Vérifier si l'identifiant de l'utilisateur à supprimer est présent dans la requête POST
if(isset($_POST['userId'])) {
    // Récupérer et valider l'identifiant de l'utilisateur à supprimer
    $userId = filter_input(INPUT_POST, 'userId', FILTER_VALIDATE_INT);
    if ($userId === false || $userId === null) {
        // Identifiant invalide
        http_response_code(400);
        echo "Identifiant de l'utilisateur invalide.";
        exit;
    }

    // Préparer et exécuter la requête de suppression
    $stmt = $bdd->prepare("DELETE FROM utilisateur WHERE id_utilisateur = :user_id");
    $stmt->execute(array(':user_id' => $userId));

    // Vérifier si la suppression a réussi
    if($stmt->rowCount() > 0) {
        // La suppression a réussi
        http_response_code(200);
        echo "L'utilisateur a été supprimé avec succès.";
    } else {
        // La suppression a échoué
        http_response_code(500);
        echo "La suppression de l'utilisateur a échoué.";
    }
} else {
    // Si l'identifiant de l'utilisateur à supprimer n'est pas présent dans la requête POST
    http_response_code(400);
    echo "Identifiant de l'utilisateur manquant.";
}
?>
