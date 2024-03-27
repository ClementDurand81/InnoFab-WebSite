<?php
// Vérifie si l'ID de l'utilisateur est défini dans la requête POST
if(isset($_POST['userId'])) {
    // Récupère l'ID de l'utilisateur à partir de la requête POST
    $userId = $_POST['userId'];

    // Connexion à la base de données
    require_once('bdd.php');

    // Prépare et exécute la requête SQL pour mettre à jour le statut valide de l'utilisateur
    $stmt = $bdd->prepare("UPDATE utilisateur SET valide = 1 WHERE id_utilisateur = :userId");
    $stmt->execute(array(':userId' => $userId));

    // Vérifie si la requête a réussi
    if($stmt) {
        // Retourne un code de succès (200)
        http_response_code(200);
        echo "L'utilisateur a été ajouté avec succès.";
    } else {
        // Retourne un code d'erreur (500) en cas d'échec de la requête
        http_response_code(500);
        echo "Une erreur s'est produite lors de l'ajout de l'utilisateur.";
    }
} else {
    // Retourne un code d'erreur (400) si l'ID de l'utilisateur n'est pas défini dans la requête POST
    http_response_code(400);
    echo "L'ID de l'utilisateur n'est pas spécifié.";
}
?>
