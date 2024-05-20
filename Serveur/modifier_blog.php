<?php
// Inclure la connexion à la base de données
require_once "bdd.php";

// Activer le rapport d'erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

function logMessage($message) {
    error_log($message);
}

// Vérifier si les données du formulaire sont envoyées via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Filtrer et échapper les données du formulaire
    $id_blog = filter_input(INPUT_POST, 'id_blog', FILTER_VALIDATE_INT);
    $nouveauTitre = filter_input(INPUT_POST, 'nouveauTitre', FILTER_SANITIZE_SPECIAL_CHARS);
    $nouvellepetiteDescription = filter_input(INPUT_POST, 'nouvellepetiteDescription', FILTER_SANITIZE_SPECIAL_CHARS);
    $nouvelleDescription1 = filter_input(INPUT_POST, 'nouvelleDescription1', FILTER_SANITIZE_SPECIAL_CHARS);
    $nouvelleDescription2 = filter_input(INPUT_POST, 'nouvelleDescription2', FILTER_SANITIZE_SPECIAL_CHARS);

    // Remplacer les retours à la ligne par des espaces dans les descriptions
    $nouvellepetiteDescription = preg_replace("/\r?\n/", " ", $nouvellepetiteDescription);
    $nouvelleDescription1 = preg_replace("/\r?\n/", " ", $nouvelleDescription1);
    $nouvelleDescription2 = preg_replace("/\r?\n/", " ", $nouvelleDescription2);

    // Vérifier et traiter les fichiers téléchargés
    $nouvelleImage1 = null;
    $nouvelleImage2 = null;
    $nouvelleImage3 = null;

    $images = [
        'nouvelleImage1' => &$nouvelleImage1,
        'nouvelleImage2' => &$nouvelleImage2,
        'nouvelleImage3' => &$nouvelleImage3
    ];

    foreach ($images as $key => &$image) {
        if (!empty($_FILES[$key]["name"])) {
            $nomFichier = basename($_FILES[$key]["name"]);
            $nouvelleImageTemp = $_FILES[$key]["tmp_name"];
            $cheminDestination = "../assets/img/imgBlogs/" . $nomFichier;

            // Vérifier le type de fichier pour éviter les attaques par téléversement
            $extensionsAutorisees = array("jpg", "jpeg", "png", "gif");
            $extensionFichier = strtolower(pathinfo($cheminDestination, PATHINFO_EXTENSION));
            if (!in_array($extensionFichier, $extensionsAutorisees)) {
                http_response_code(400);
                echo json_encode(array("message" => "Extension de fichier non autorisée"));
                exit;
            }

            // Déplacer le fichier téléchargé vers le dossier de destination
            if (move_uploaded_file($nouvelleImageTemp, $cheminDestination)) {
                // Le fichier a été déplacé avec succès
                $image = $cheminDestination;
                logMessage("Fichier déplacé avec succès: $cheminDestination");
            } else {
                // Une erreur s'est produite lors du déplacement du fichier
                http_response_code(500);
                echo json_encode(array("message" => "Erreur lors du téléchargement de l'image"));
                exit;
            }
        }
    }

    // Effectuer les modifications dans la base de données
    $sql = "UPDATE blogs SET Titre = :titre, petiteDescription = :petiteDescription, Description_1 = :description1, Description_2 = :description2";
    if ($nouvelleImage1 !== null) {
        $sql .= ", Image_1 = :image1";
    }
    if ($nouvelleImage2 !== null) {
        $sql .= ", Image_2 = :image2";
    }
    if ($nouvelleImage3 !== null) {
        $sql .= ", Image_3 = :image3";
    }
    $sql .= " WHERE id_blog = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(":titre", $nouveauTitre);
    $stmt->bindParam(":petiteDescription", $nouvellepetiteDescription);
    $stmt->bindParam(":description1", $nouvelleDescription1);
    $stmt->bindParam(":description2", $nouvelleDescription2);
    if ($nouvelleImage1 !== null) {
        $stmt->bindParam(":image1", $nouvelleImage1);
    }
    if ($nouvelleImage2 !== null) {
        $stmt->bindParam(":image2", $nouvelleImage2);
    }
    if ($nouvelleImage3 !== null) {
        $stmt->bindParam(":image3", $nouvelleImage3);
    }
    $stmt->bindParam(":id", $id_blog, PDO::PARAM_INT);

    // Exécuter la requête
    if ($stmt->execute()) {
        logMessage("Modification réussie pour le blog ID: $id_blog");
        http_response_code(200);
        echo json_encode(array("message" => "Modification réussie"));
    } else {
        logMessage("Erreur lors de la modification pour le blog ID: $id_blog");
        http_response_code(500);
        echo json_encode(array("message" => "Erreur lors de la modification"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Requête invalide"));
}
?>
