<?php
// Vérifie si l'utilisateur est connecté
session_start();
require_once('Serveur/bdd.php'); // Assurez-vous de remplacer 'bdd.php' avec le chemin correct vers votre fichier de connexion

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
            echo '<li><a class="nav-link scrollto" href="Administration/dashboard.php">Administration</a></li>';
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
            echo '<li><a class="nav-link scrollto" href="Serveur/profil.php">Mon compte</a></li>';
            echo '<li class="separator"></li>';
            echo '<li><a class="nav-link scrollto" href="Serveur/deconnexion.php">Déconnexion</a></li>';
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
      <h5 class="mt-5 pt-4 text-center">Membres Fondateurs</h5>
      <hr class="horizontal-line">
    </div>
  </section>

  <!-- Values Section -->
  <section id="values" class="values">
    <div class="container section-header" data-aos="fade-up" data-aos-delay="600">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="p-3">
            <h3>Le groupe Pierre Fabre, fondé en 1962 par Pierre Fabre, est un leader mondial dans le domaine pharmaceutique et dermo-cosmétique. 
              Spécialisé dans la recherche, le développement et la commercialisation de produits de santé et de beauté, l'entreprise est présente 
              dans plus de 130 pays.</h3>
          </div>
        </div>
        <div class="col-md-6 text-center">
          <div class="p-3">
            <img src="assets/img/pierre-fabre.jpg" alt="" class="custom-image-infos-2 p-4">
          </div>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-6 order-md-2 text-right-offset">
          <div class="p-3">
            <h3>La CCI du Tarn, en Occitanie, représente et soutient les entreprises locales. Elle propose des services de conseil, de formation, d'innovation 
              et d'internationalisation pour favoriser leur développement. Elle contribue également à promouvoir le commerce, l'industrie et le tourisme dans 
              la région, stimulant ainsi la croissance économique et le dynamisme entrepreneurial du département.</h3>
          </div>
        </div>
        <div class="col-md-6 text-center order-md-1">
          <div class="p-3">
            <img src="assets/img/cci-tarn.jpg" alt="" class="custom-image-infos-2 p-4">
          </div>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="p-3">
            <h3>Le Syndicat Mixte pour l'Enseignement du Sud du Tarn rassemble diverses collectivités locales pour optimiser leurs ressources et coordonner 
              leurs actions éducatives. Son objectif est d'améliorer l'offre éducative dans la région en favorisant la collaboration entre institutions et 
              en développant des projets novateurs, comme la construction d'écoles, les activités périscolaires et le soutien à la scolarité.</h3>
          </div>
        </div>
        <div class="col-md-6 text-center">
          <div class="p-3">
            <img src="assets/img/enseignement-superieur.jpg" alt="" class="custom-image-infos-3 p-4">
          </div>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-6 order-md-2 text-right-offset">
          <div class="p-3">
            <h3>Castres-Mazamet Technopole est un hub d'innovation basé dans le département du Tarn, en France. Il soutient les entreprises locales en 
              favorisant l'innovation, la recherche et l'entrepreneuriat. Son objectif est de stimuler la croissance économique en encourageant la 
              collaboration entre les entreprises, les institutions académiques et les acteurs de la recherche.</h3>
          </div>
        </div>
        <div class="col-md-6 text-center order-md-1">
          <div class="p-3">
            <img src="assets/img/technopole.png" alt="" class="custom-image-infos-2 p-4">
          </div>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="p-3">
            <h3>Sirea Group est une entreprise spécialisée dans les solutions énergétiques et l'automatisation industrielle. Depuis sa fondation 
              en 2004, elle se concentre sur le développement et la mise en œuvre de systèmes intelligents pour la gestion de l'énergie, les énergies 
              renouvelables et l'automatisation des processus industriels.</h3>
          </div>
        </div>
        <div class="col-md-6 text-center">
          <div class="p-3">
            <img src="assets/img/sirea.jpg" alt="" class="custom-image-infos-2 p-4">
          </div>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-6 order-md-2 text-right-offset">
          <div class="p-3">
            <h3>BeProject est une société de développement web qui se spécialise dans la création de solutions numériques personnalisées pour ses clients. 
              Leur équipe experte travaille sur une variété de projets, des sites web simples aux applications web complexes, en mettant l'accent sur la 
              satisfaction client et l'innovation.</h3>
          </div>
        </div>
        <div class="col-md-6 text-center order-md-1">
          <div class="p-4">
            <img src="assets/img/be-project.png" alt="" class="custom-image-infos-2 p-4">
          </div>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="p-3">
            <h3>L'IUT de Castres, intégré à l'Université Toulouse-Jean Jaurès, offre des formations professionnelles de niveau Bac+2 à Bac+3 dans divers 
              domaines techniques comme l'informatique, les réseaux, le génie électrique et mécanique. Son enseignement pratique et théorique vise 
              à préparer les étudiants à entrer dans le monde professionnel ou à poursuivre leurs études.</h3>
          </div>
        </div>
        <div class="col-md-6 text-center">
          <div class="p-3">
            <img src="assets/img/iut-castres.png" alt="" class="custom-image-infos-2 p-4">
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