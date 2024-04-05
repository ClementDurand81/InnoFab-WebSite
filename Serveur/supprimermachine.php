<?php
// Connexion à la base de données
require_once('bdd.php');

// Vérifier si l'identifiant de la machine à supprimer est présent dans la requête POST
$machineID = filter_input(INPUT_POST, 'machineID', FILTER_VALIDATE_INT);
if($machineID !== false && $machineID !== null) {
    // Préparer et exécuter la requête de suppression
    try {
        $stmt = $bdd->prepare("DELETE FROM machines WHERE id_machines = :machineID");
        $stmt->execute(array(':machineID' => $machineID));

        // Vérifier si la suppression a réussi
        if($stmt->rowCount() > 0) {
            // La suppression a réussi
            echo "La Machine a été supprimée avec succès.";
        } else {
            // La suppression a échoué
            echo "La suppression de la Machine a échoué.";
        }
    } catch(PDOException $e) {
        // Gérer les erreurs PDO de manière sécurisée
        echo "Une erreur s'est produite lors de la suppression de la Machine.";
        // Vous pouvez également enregistrer ou journaliser l'erreur pour un débogage ultérieur
    }
} else {
    // Si l'identifiant de la Machine à supprimer n'est pas présent dans la requête POST
    header('Location: ../Administration/dashboard_machines.php');
    exit; // Assurez-vous de quitter le script après la redirection
}
?>
