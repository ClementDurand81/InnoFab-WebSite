<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure la connexion à la base de données
    require_once "bdd.php";

    // Fonction pour nettoyer les données
    function cleanInput($data)
    {
        // Supprimer les balises HTML et PHP et appliquer l'échappement de caractères spéciaux
        return htmlspecialchars(strip_tags(trim($data)));
    }

    // Vérifier si les champs sont vides
    if (!empty($_POST['nom']) && !empty($_FILES['image1']['name']) && !empty($_POST['petiteDescription']) && !empty($_POST['description1']) && !empty($_FILES['image2']['name'])  && !empty($_POST['description2']) && !empty($_FILES['image3']['name'])) {
        // Récupérer et nettoyer les données du formulaire
        $nom = cleanInput($_POST['nom']);
        // Supprimer les retours à la ligne des descriptions
        $petiteDescription = cleanInput(preg_replace("/\r?\n/", " ", $_POST['petiteDescription']));
        $description1 = cleanInput(preg_replace("/\r?\n/", " ", $_POST['description1']));
        $description2 = cleanInput(preg_replace("/\r?\n/", " ", $_POST['description2']));

        // Tableau pour stocker les destinations des images
        $image_destinations = [];

        // Traitement des images
        for ($i = 1; $i <= 3; $i++) {
            $image = $_FILES['image' . $i];
            $image_name = cleanInput($image['name']);
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
                $image_destination = '../assets/img/imgBlogs/' . $image_name;

                // Déplacer l'image téléchargée vers le dossier d'uploads
                if (move_uploaded_file($image_tmp, $image_destination)) {
                    $image_destinations[] = $image_destination;
                } else {
                    echo "Erreur lors du téléchargement de l'image " . $i . ".";
                    exit;
                }
            } else {
                echo "Erreur : Format d'image non pris en charge pour l'image " . $i . ". Veuillez télécharger une image au format jpg, jpeg, png ou gif.";
                exit;
            }
        }

        try {
            // Préparation de la requête SQL avec des paramètres nommés
            $sql = "INSERT INTO blogs (Titre, Image_1, Image_2, Image_3, petiteDescription, Description_1, Description_2) VALUES (:nom, :image1, :image2, :image3, :petiteDescription, :description1, :description2)";
            $stmt = $bdd->prepare($sql);

            // Liaison des valeurs aux paramètres nommés
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':image1', $image_destinations[0]);
            $stmt->bindParam(':petiteDescription', $petiteDescription);
            $stmt->bindParam(':description1', $description1);
            $stmt->bindParam(':image2', $image_destinations[1]);
            $stmt->bindParam(':description2', $description2);
            $stmt->bindParam(':image3', $image_destinations[2]);

            // Exécution de la requête
            if ($stmt->execute()) {
                // Si l'ajout est réussi, rediriger vers dashboard_machine.php avec un paramètre de succès
                header("Location: ../Administration/dashboard_blog.php?success=true");
                exit;
            } else {
                echo "Erreur lors de l'exécution de la requête.";
            }
        } catch (PDOException $e) {
            // En cas d'erreur lors de l'exécution de la requête, affichage de l'erreur
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Erreur : Veuillez remplir tous les champs.";
    }
}
?>
