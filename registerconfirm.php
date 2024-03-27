<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $nom = $_POST['name'];
    $prenom = $_POST['surname'];
    $email = $_POST['email'];
    $telephone = $_POST['phone'];
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
                header("Location: index.php?inscription=reussie");
                exit;
            }
        }
    }
} else {
    // Redirection vers la page de formulaire si le formulaire n'a pas été soumis
    header("Location: register.php");
    exit;
}
?>
