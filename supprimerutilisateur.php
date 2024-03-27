<?php
// Connexion à la base de données
require_once('bdd.php');

// Vérifier si l'identifiant de l'utilisateur à supprimer est présent dans la requête POST
if(isset($_POST['userId'])) {
    // Récupérer l'identifiant de l'utilisateur à supprimer depuis la requête POST
    $userId = $_POST['userId'];

    // Préparer et exécuter la requête de suppression
    $stmt = $bdd->prepare("DELETE FROM utilisateur WHERE id_utilisateur = :user_id");
    $stmt->execute(array(':user_id' => $userId));

    // Vérifier si la suppression a réussi
    if($stmt->rowCount() > 0) {
        // La suppression a réussi
        echo "L'utilisateur a été supprimé avec succès.";
    } else {
        // La suppression a échoué
        echo "La suppression de l'utilisateur a échoué.";
    }
} else {
    // Si l'identifiant de l'utilisateur à supprimer n'est pas présent dans la requête POST
    echo "Identifiant de l'utilisateur manquant.";
}
?>
