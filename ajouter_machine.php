<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure la connexion à la base de données
    include "bdd.php";

    // Vérifier si les champs sont vides
    if (!empty($_POST['nom']) && !empty($_FILES['image']['name']) && !empty($_POST['description'])) {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $description = $_POST['description'];

        // Traitement de l'image
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $image_size = $image['size'];
        $image_error = $image['error'];

        // Obtenir l'extension de l'image
        $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        // Tableau des extensions autorisées
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

        // Vérifier si l'extension est autorisée
        if (in_array($image_extension, $allowed_extensions)) {
            // Chemin de destination de l'image
            $image_destination = 'assets/img/imgMachines/' . $image_name;

            // Déplacer l'image téléchargée vers le dossier d'uploads
            if (move_uploaded_file($image_tmp, $image_destination)) {
                try {
                    // Préparation de la requête SQL avec des paramètres nommés
                    $sql = "INSERT INTO machines (Titre, Image, Description) VALUES (:nom, :image_destination, :description)";
                    $stmt = $bdd->prepare($sql);
                    
                    // Liaison des valeurs aux paramètres nommés
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':image_destination', $image_destination);
                    $stmt->bindParam(':description', $description);

                    // Exécution de la requête
                    if ($stmt->execute()) {
                        // Si l'ajout est réussi, rediriger vers dashboard_machine.php avec un paramètre de succès
                        echo "<script>window.location.href = 'dashboard_machines.php?success=true';</script>";
                    } else {
                        echo "Erreur lors de l'exécution de la requête.";
                    }
                } catch(PDOException $e) {
                    // En cas d'erreur lors de l'exécution de la requête, affichage de l'erreur
                    echo "Erreur : " . $e->getMessage();
                }
            } else {
                echo "Erreur lors du téléchargement de l'image.";
            }
        } else {
            echo "Erreur : Format d'image non pris en charge. Veuillez télécharger une image au format jpg, jpeg, png ou gif.";
        }
    } else {
        echo "Erreur : Veuillez remplir tous les champs.";
    }
}
?>
