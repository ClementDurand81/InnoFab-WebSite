<?php
// Connexion à la base de données
require_once('bdd.php');

// Fonction pour afficher une alerte JavaScript
function showAlert($message) {
    // Utilisation de json_encode pour échapper les caractères spéciaux
    echo "<script>alert(" . json_encode($message) . "); window.location.href = 'login.php';</script>";
    exit;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si les champs email et mot de passe sont remplis
    if (empty($email) || empty($password)) {
        showAlert('Veuillez remplir tous les champs.');
    }
    
    // Récupérer le mot de passe hashé associé à l'email fourni
    $stmt = $bdd->prepare("SELECT id_utilisateur, Password, valide FROM utilisateur WHERE email = :email");
    $stmt->execute(array(':email' => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Vérifier si l'utilisateur est valide pour se connecter
        if ($row['valide'] == 0) {
            showAlert('Votre profil n\'a pas été accepté.');
        } else {
            // Comparer le mot de passe entré par l'utilisateur avec celui stocké dans la base de données
            if (password_verify($password, $row['Password'])) {
                $user_id = $row['id_utilisateur'];
                session_start();
                // Mot de passe correct, connecter l'utilisateur
                $_SESSION['user_id'] = $user_id;
                // Rediriger l'utilisateur vers la page d'accueil après la connexion réussie
                header("Location: index.php");
                exit;
            } else {
                // Mot de passe incorrect
                showAlert('Mot de passe incorrect.');
            }
        }
    } else {
        // L'utilisateur avec cet email n'existe pas
        showAlert('Aucun utilisateur trouvé avec cet e-mail.');
    }
} else {
    // Redirection vers la page de connexion si le formulaire n'a pas été soumis
    showAlert('Le formulaire n\'a pas été soumis.');
}

?>
