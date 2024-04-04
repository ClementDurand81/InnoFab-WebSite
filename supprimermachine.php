<?php
// Connexion à la base de données
require_once('bdd.php');

// Vérifier si l'identifiant de la machine à supprimer est présent dans la requête POST
if(isset($_POST['machineID'])) {
    // Récupérer l'identifiant de la machine à supprimer depuis la requête POST
    $machineID = $_POST['machineID'];

    // Préparer et exécuter la requête de suppression
    $stmt = $bdd->prepare("DELETE FROM machines WHERE id_machines = :machineID");
    $stmt->execute(array(':machineID' => $machineID));

    // Vérifier si la suppression a réussi
    if($stmt->rowCount() > 0) {
        // La suppression a réussi
        echo "La Machine a été supprimé avec succès.";
    } else {
        // La suppression a échoué
        echo "La suppression de la Machine a échoué.";
    }
} else {
    // Si l'identifiant de la Machine à supprimer n'est pas présent dans la requête POST
    echo "Identifiant de la Machine est manquant.";
}
?>
