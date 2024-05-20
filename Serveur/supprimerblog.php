<?php
// Connexion à la base de données
require_once('bdd.php');

// Vérifier si l'identifiant de la machine à supprimer est présent dans la requête POST
$id_blog = filter_input(INPUT_POST, 'id_blog', FILTER_VALIDATE_INT);
if($id_blog !== false && $id_blog !== null) {
    // Préparer et exécuter la requête de suppression
    try {
        $stmt = $bdd->prepare("DELETE FROM blogs WHERE id_blog = :id_blog");
        $stmt->execute(array(':id_blog' => $id_blog));

        // Vérifier si la suppression a réussi
        if($stmt->rowCount() > 0) {
            // La suppression a réussi
            echo "La blog a été supprimée avec succès.";
        } else {
            // La suppression a échoué
            echo "La suppression du blog a échoué.";
        }
    } catch(PDOException $e) {
        // Gérer les erreurs PDO de manière sécurisée
        echo "Une erreur s'est produite lors de la suppression du blog";
        // Vous pouvez également enregistrer ou journaliser l'erreur pour un débogage ultérieur
    }
} else {
    // Si l'identifiant du blog à supprimer n'est pas présent dans la requête POST
    header('Location: ../Administration/dashboard_blogs.php');
    exit; // Assurez-vous de quitter le script après la redirection
}
?>
