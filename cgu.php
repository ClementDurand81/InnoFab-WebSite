<?php
// Vérifie si l'utilisateur est connecté
session_start();
require_once('bdd.php'); // Assurez-vous de remplacer 'bdd.php' avec le chemin correct vers votre fichier de connexion

// Définit une valeur par défaut pour $isAdmin
$isAdmin = false;

if (isset($_SESSION['user_id'])) {
  // Récupérer le statut de l'utilisateur à partir de la base de données
  $userId = $_SESSION['user_id'];
  $stmt = $bdd->prepare("SELECT Status FROM utilisateur WHERE id_utilisateur = :user_id");
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
  <link href="assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- Header -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <!-- Logo à gauche -->
      <div class="logo">
        <a href="index.php" class="d-flex align-items-center">
          <img src="assets/img/logo.png" alt="">
        </a>
      </div>

      <!-- Boutons au milieu -->
      <nav class="navbar">
        <ul class="d-flex justify-content-center">
          <li><a class="nav-link scrollto" href="index.php">Accueil</a></li>
          <li><a class="nav-link scrollto" href="nos-machines.php">Machines</a></li>
          <li><a class="nav-link scrollto" href="blog.php">Blog</a></li>
          <li><a class="nav-link scrollto" href="tarifs.php">Tarifs</a></li>
          <li><a class="nav-link scrollto" href="contact.php">Contact</a></li>
          <li><a class="nav-link scrollto" href="notre-camion.php">Camion</a></li>
          <?php
          // Si l'utilisateur est un administrateur, afficher le bouton "Administration"
          if ($isAdmin) {
            echo '<li><a class="nav-link scrollto" href="dashboard.php">Administration</a></li>';
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

  <!-- Background Section  -->
  <section class="background-custom-2 d-flex align-items-center">
    <div class="mt-5 container" data-aos="fade-up" data-aos-delay="400">
      <h5 class="mt-5 pt-4 text-center">Conditions Générales d'Utilisation</h5>
      <hr class="horizontal-line">
    </div>
  </section>

  <!-- Values Section -->
  <section id="values" class="values">
    <div class="container section-header" data-aos="fade-up" data-aos-delay="600">
      <h4><strong>Conditions Générales d'Utilisation (CGU) d'Innofab</strong></h4>
      <p><strong>ARTICLE 1. ACCEPTATION DES CONDITIONS GÉNÉRALES D'UTILISATION</strong></p>
      <p>Les CGU s’appliquent à tout commencement d’utilisation du Site par un Utilisateur.</p>
      <p>En accédant et en utilisant le Site, l’Utilisateur accepte sans réserve ni condition les CGU et s’engage à les respecter en tous points.</p>
      <p>La Société peut à tout moment modifier les termes des CGU. L’Utilisateur est expressément informé que les CGU applicables sont celles en vigueur, pour l’Utilisateur au jour de l’utilisation du Site.</p>
      <p>La Société encourage les Utilisateurs à consulter régulièrement les CGU pour s’assurer d’être informés des modifications apportées.</p>
      <p><strong>2. Traduction en Anglais</strong></p>
      <p>Innofab propose une traduction complète du site en anglais pour faciliter l'accès aux informations et services pour les utilisateurs anglophones. Cette initiative comprend :</p>
      <p>2.1. La traduction en anglais de toutes les pages du site, y compris la page d'accueil, la section machines, la page de réservation, les espaces utilisateurs, les mentions légales, et autres sections pertinentes.</p>
      <p>2.2. Une traduction professionnelle de chaque bloc de texte, avec l’utilisation d’un vocabulaire adapté au secteur d'Innofab.</p>
      <p>2.3. L'adaptation de l'interface utilisateur à la langue anglaise, avec un sélecteur de langue permettant aux utilisateurs de basculer entre la version française et anglaise.</p>
      <p><strong>3. Page Machines</strong></p>
      <p>La page présente les différentes machines disponibles chez Innofab avec des informations détaillées sur chacune d'entre elles.</p>
      <p><strong>4. Site Responsive</strong></p>
      <p>Le site offre une expérience utilisateur optimale sur ordinateur, tablette, et smartphone en proposant des formats adaptés.</p>
      <p><strong>5. Réservations</strong></p>
      <p>5.1. L’accès aux réservations est restreint aux adhérents.</p>
      <p>5.2. Pour effectuer une réservation, l’adhérent doit d’abord remplir puis envoyer un formulaire de contact.</p>
      <p>5.3. Chaque demande de réservation sera validée ou rejetée manuellement par un administrateur.</p>
      <p><strong>6. Espaces Utilisateurs</strong></p>
      <p>6.1. Le site comporte trois espaces utilisateurs distincts : visiteur, adhérent, administrateur.</p>
      <p>6.2. Les accès aux espaces adhérent et administrateur sont sécurisés par une authentification par mot de passe.</p>
      <p><strong>7. Base de Données</strong></p>
      <p>Le site d’Innofab est lié à une base de données pour stocker les informations des adhérents, les réservations, et d'autres données pertinentes.</p>
      <p><strong>8. Blog</strong></p>
      <p>La page Blog, alimentée par l’administrateur du site, présente les actualités d'Innofab.</p>
    </div>
  </section>

  <!-- Footer -->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-12 footer-info">
          <p>Innofab est financé par l'Union Européenne dans le cadre du Fond feder</p>
          <a class="logo d-flex align-items-center justify-content-center">
            <img src="assets/img/ue.jpg" alt="">
            <img src="assets/img/occitanie.png" alt="">
            <img src="assets/img/europesengage.jpg" alt="">
            <img src="assets/img/mit.png" alt="">
          </a>
        </div>
        <div class="col-2 footer-links">
          <h4>Publications</h4>
          <ul>
            <li><a href="nos-machines.php">Nos machines</a></li>
            <li><a href="notre-camion.php">Notre camion</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="membres-fondateurs.php">Membres fondateurs</a></li>
          </ul>
        </div>
        <div class="col-2 footer-links">
          <h4>Innofab</h4>
          <ul>
            <li><a href="tarifs.php">Nos tarifs</a></li>
            <li><a href="contact.php">Nous contacter</a></li>
          </ul>
        </div>
        <div class="col-2 footer-links">
          <h4>Services</h4>
          <ul>
            <li><a href="cgu.php">CGU</a></li>
            <li><a href="mentions-legales.php">Mentions légales</a></li>
            <li><a href="politique-de-confidentialite.php">Politique de confidentialité</a></li>
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

  <?php
  if (isset($_GET['inscription']) && $_GET['inscription'] == 'reussie') {
    echo "<script>alert('Inscription réussie !');</script>";
  }
  ?>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>