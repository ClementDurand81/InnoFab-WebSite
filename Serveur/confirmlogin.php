<?php
// Connexion à la base de données
require_once('bdd.php');

// Fonction pour afficher une alerte JavaScript
function showAlert($message) {
    echo "<script>alert(" . json_encode($message) . "); window.location.href = '../login.php';</script>";
    exit;
}

// Vérifier si le formulaire a été soumis de manière sécurisée
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Filtrage des entrées utilisateur
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    // Vérifier si les champs email et mot de passe sont remplis
    if (empty($email) || empty($password)) {
        showAlert('Veuillez remplir tous les champs.');
    }
    
    // Préparation de la requête sécurisée pour récupérer le mot de passe hashé associé à l'email fourni
    $stmt = $bdd->prepare("SELECT id_utilisateur, Password, valide FROM utilisateur WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Vérifier si l'utilisateur est valide pour se connecter
        if ($row['valide'] == 0) {
            showAlert('Votre profil n\'a pas été accepté.');
        } else {
            // Vérifier si le mot de passe correspond
            if (password_verify($password, $row['Password'])) {
                // Démarrer la session et connecter l'utilisateur
                session_start();
                $_SESSION['user_id'] = $row['id_utilisateur'];
                // Rediriger l'utilisateur vers la page d'accueil après la connexion réussie
                header("Location: ../index.php");
                exit;
            } else {
                showAlert('Mot de passe incorrect.');
            }
        }
    } else {
        showAlert('Aucun utilisateur trouvé avec cet e-mail.');
    }
} else {
    showAlert('Le formulaire n\'a pas été soumis.');
}
?>
