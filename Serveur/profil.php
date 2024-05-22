<?php
// Vérifie si l'utilisateur est connecté
session_start();
require_once('bdd.php'); // Assurez-vous de remplacer 'bdd.php' avec le chemin correct vers votre fichier de connexion

// Définit une valeur par défaut pour $isAdmin
$isAdmin = false;

if (!isset($_SESSION['user_id'])) {
  // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
  header("Location: ../login.php");
  exit;
}

if (isset($_SESSION['user_id'])) {
  // Récupérer le statut de l'utilisateur à partir de la base de données
  $userId = $_SESSION['user_id'];
  $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :user_id");
  $stmt->execute(array(':user_id' => $userId));
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Vérifier si l'utilisateur est un administrateur
  if ($user && $user['Status'] === 'Admin') {
    $isAdmin = true;
    $_SESSION['is_admin'] = $isAdmin;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Innofab</title>

  <!-- Favicons -->
  <link href="/assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- Header -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <!-- Logo à gauche -->
      <div class="logo">
        <a href="index.php" class="d-flex align-items-center">
          <img src="/assets/img/logo.png" alt="">
        </a>
      </div>

      <!-- Boutons au milieu -->
      <nav class="navbar">
        <ul class="d-flex justify-content-center">
          <li><a class="nav-link scrollto" href="/index.php">Accueil</a></li>
          <li><a class="nav-link scrollto" href="/nos-machines.php">Machines</a></li>
          <li><a class="nav-link scrollto" href="/blog.php">Blog</a></li>
          <li><a class="nav-link scrollto" href="/tarifs.php">Tarifs</a></li>
          <li><a class="nav-link scrollto" href="/contact.php">Contact</a></li>
          <li><a class="nav-link scrollto" href="/notre-camion.php">Camion</a></li>
          <?php
          // Si l'utilisateur est un administrateur, afficher le bouton "Administration"
          if ($isAdmin) {
            echo '<li><a class="nav-link scrollto" href="/Administration/dashboard.php">Administration</a></li>';
          }
          ?>
        </ul>
      </nav>

      <!-- Login à droite -->
      <nav class="navbar">
        <ul class="d-flex align-items-center justify-content-end">
          <?php
          // Si l'utilisateur est connecté, afficher le bouton "Mon compte" et "Déconnexion"
          if (isset($_SESSION['user_id'])) {
            echo '<li><a class="nav-link scrollto" href="profil.php">Mon compte</a></li>';
            echo '<li class="separator"></li>';
            echo '<li><a class="nav-link scrollto" href="deconnexion.php">Déconnexion</a></li>';
          } else {
            // Sinon, afficher les boutons "Se connecter" et "S'enregistrer"
            echo '<li><a class="nav-link scrollto" href="login.php">Connexion</a></li>';
            echo '<li class="separator"></li>';
            echo '<li><a class="nav-link scrollto" href="register.php">S\'enregistrer</a></li>';
          }
          ?>
        </ul>
      </nav>

    </div>
  </header>

  <!-- Main Section -->
  <section class="background-custom-3 d-flex align-items-center">
    <div class="container" data-aos="fade-up" data-aos-delay="400">
      <h5 class="mt-5 pt-4 text-center">Mon profil</h5>
      <hr class="horizontal-line">
      <div class="mt-5" data-aos="fade-up" data-aos-delay="600">
        <div class="profile-container">
          <div class="row align-items-center">
            <!-- Image de profil-->
            <div class="col-md-12 text-center">
              <div class="profile-picture-container">
                <img src="/assets/img/profil.png" class="profile-picture">
              </div>
              <h3 class="mt-4">Bonjour, <?php echo $user['Nom']; ?></h3> <!-- Affiche le nom de l'utilisateur -->
            </div>
            <div class="col-md-12 vertical-line"></div>
            <!-- Informations du profil -->
            <div class="col-md-6">
              <!-- Nom et prénom -->
              <div class="profile-info">
                <h4><strong>Nom :</strong> <?php echo $user['Nom']; ?></h4>
                <h4><strong>Prénom :</strong> <?php echo $user['Prenom']; ?></h4>
              </div>
              <!-- Adresse mail -->
              <div class="profile-info">
                <h4><strong>Email :</strong> <?php echo $user['email']; ?></h4>
              </div>
              <!-- Numéro de téléphone -->
              <div class="profile-info">
                <h4><strong>Téléphone :</strong> <?php echo $user['Telephone']; ?></h4>
              </div>
            </div>
            <!-- Boutons d'action -->
            <div class="col-md-6">
              <div class="action-buttons">
                <button class="btn-form" onclick="confirmerSuppression()">Supprimer mon compte</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-12 footer-info">
          <p>Innofab est financé par l'Union Européenne dans le cadre du Fond feder</p>
          <a class="logo d-flex align-items-center justify-content-center">
            <img src="/assets/img/ue.jpg" alt="">
            <img src="/assets/img/occitanie.png" alt="">
            <img src="/assets/img/europesengage.jpg" alt="">
            <img src="/assets/img/mit.png" alt="">
          </a>
        </div>
        <div class="col-2 footer-links">
          <h4>Publications</h4>
          <ul>
            <li><a href="/nos-machines.php">Nos machines</a></li>
            <li><a href="/notre-camion.php">Notre camion</a></li>
            <li><a href="/blog.php">Blog</a></li>
            <li><a href="/membres-fondateurs.php">Membres fondateurs</a></li>
          </ul>
        </div>
        <div class="col-2 footer-links">
          <h4>Innofab</h4>
          <ul>
            <li><a href="/tarifs.php">Nos tarifs</a></li>
            <li><a href="/contact.php">Nous contacter</a></li>
          </ul>
        </div>
        <div class="col-2 footer-links">
          <h4>Services</h4>
          <ul>
            <li><a href="/cgu.php">CGU</a></li>
            <li><a href="/mentions-legales.php">Mentions légales</a></li>
            <li><a href="/politique-de-confidentialite.php">Politique de confidentialité</a></li>
          </ul>
        </div>
        <div class="row footer-bottom">
          <div class="col-auto align-self-center">
            <p><i class="bi bi-envelope"></i> : fabmanager.innofab@gmail.com</p>
          </div>
          <div class="col-auto align-self-center">
            <p><i class="bi bi-clock"></i> : Mercredi - Jeudi - Vendredi | 10h - 12h 14h - 18h</p>
          </div>
          <div class="col align-self-center">
            <p><i class="bi bi-telephone"></i> : 07.49.10.60.31</p>
          </div>
          <div class="col-auto ml-auto">
            <div class="social-links">
              <a href="https://www.facebook.com/innofabcastres" class="social-link facebook"><i class="bi bi-facebook"></i></a>
              <a href="https://discord.com/invite/nTcpBuD" class="social-link discord"><i class="bi bi-discord"></i></a>
              <a href="https://www.instagram.com/fablab_innofab" class="social-link instagram"><i class="bi bi-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/aos/aos.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>

  <script>
    function confirmerSuppression() {
      if (confirm("Êtes-vous sûr de vouloir supprimer définitivement votre compte ? Cette action est irréversible.")) {
        window.location.href = "supprimercompte.php";
      }
    }
  </script>
</body>

</html>