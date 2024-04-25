<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire après les avoir nettoyées
    $nom = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $prenom = filter_var($_POST['surname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telephone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Vérifie si tous les champs sont remplis
    if (empty($nom) || empty($prenom) || empty($email) || empty($telephone) || empty($password) || empty($confirmPassword)) {
        echo "<script>alert('Veuillez remplir tous les champs du formulaire.');</script>";
    } else {
        // Vérifie si les mots de passe correspondent
        if ($password != $confirmPassword) {
            echo "<script>alert('Les mots de passe ne correspondent pas.');</script>";
        } else {
            // Crypte le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Connexion à la base de données
            require_once('bdd.php'); // Assurez-vous de remplacer 'bdd.php' avec le chemin correct vers votre fichier de connexion

            try {
                // Vérifie si l'e-mail existe déjà dans la base de données
                $stmt = $bdd->prepare("SELECT email FROM utilisateur WHERE email = :email");
                $stmt->execute(array(':email' => $email));
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    echo "<script>alert('Cette adresse e-mail est déjà utilisée. Veuillez en choisir une autre.');</script>";
                } else {
                    // Requête d'insertion des données dans la base de données
                    $sql = "INSERT INTO utilisateur (Nom, Prenom, email, Telephone, Password) VALUES (:nom, :prenom, :email, :telephone, :password)";
                    $stmt = $bdd->prepare($sql);

                    // Exécute la requête avec les valeurs des paramètres
                    $stmt->execute(array(
                        ':nom' => $nom,
                        ':prenom' => $prenom,
                        ':email' => $email,
                        ':telephone' => $telephone,
                        ':password' => $hashedPassword
                    ));

                    // Affiche un message de succès
                    header("Location: ../index.php?inscription=reussie");
                    exit;
                }
            } catch (PDOException $e) {
                // En cas d'erreur de base de données, affichez un message générique et enregistrez les détails de l'erreur dans un fichier de journal
                error_log('Erreur de base de données: ' . $e->getMessage());
                echo "<script>alert('Une erreur s'est produite lors du traitement de votre demande. Veuillez réessayer plus tard.');</script>";
            }
        }
    }
} else {
    // Redirection vers la page de formulaire si le formulaire n'a pas été soumis
    header("Location: ../register.php");
    exit;
}
