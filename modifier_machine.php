<?php
// Inclure la connexion à la base de données
include "bdd.php";

// Vérifier si les données du formulaire sont envoyées via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupérer les données du formulaire
    $id_machine = $_POST["id_machine"];
    $nouveauTitre = $_POST["nouveauTitre"];
    $nouvelleDescription = $_POST["nouvelleDescription"];

    // Vérifier si un fichier a été téléchargé
    if (!empty($_FILES["image"]["name"])) {
        // Récupérer les informations sur le fichier téléchargé
        $nomFichier = $_FILES["image"]["name"];
        $nouvelleImageTemp = $_FILES["image"]["tmp_name"];
        $cheminDestination = "assets/img/imgMachines/" . $nomFichier;

        // Déplacer le fichier téléchargé vers le dossier de destination
        if (move_uploaded_file($nouvelleImageTemp, $cheminDestination)) {
            // Le fichier a été déplacé avec succès
            $nouvelleImage = $cheminDestination;
        } else {
            // Une erreur s'est produite lors du déplacement du fichier
            http_response_code(500);
            echo json_encode(array("message" => "Erreur lors du téléchargement de l'image"));
            exit; // Arrêter l'exécution du script en cas d'erreur
        }
    } else {
        // Aucun fichier n'a été téléchargé, garder l'image existante
        $nouvelleImage = null;
    }
    
    // Effectuer les modifications dans la base de données
    $sql = "UPDATE machines SET Titre = :titre, Description = :description";
    // Ajouter la colonne de l'image uniquement si une nouvelle image a été téléchargée
    if ($nouvelleImage !== null) {
        $sql .= ", Image = :image";
    }
    $sql .= " WHERE id_machines = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(":titre", $nouveauTitre);
    $stmt->bindParam(":description", $nouvelleDescription);
    // Lier le paramètre de l'image uniquement si une nouvelle image a été téléchargée
    if ($nouvelleImage !== null) {
        $stmt->bindParam(":image", $nouvelleImage);
    }
    $stmt->bindParam(":id", $id_machine);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Modification réussie
        http_response_code(200);
        echo json_encode(array("message" => "Modification réussie"));
    } else {
        // Erreur lors de la modification
        http_response_code(500);
        echo json_encode(array("message" => "Erreur lors de la modification"));
    }
} else {
    // Requête invalide
    http_response_code(400);
    echo json_encode(array("message" => "Requête invalide"));
}
?>