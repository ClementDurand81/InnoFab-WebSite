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
  <section class="background-custom d-flex align-items-center">
    <div class="container" data-aos="fade-up" data-aos-delay="400">
      <h5 class="mt-5 pt-4 text-center">Comment ça marche ?</h5>
      <hr class="horizontal-line">
      <h2>Innofab a pour but de promouvoir la fabrication par le numérique et la collaboration.
        Ici vous avez la possibilité de faire aboutir vos projets de fabrication dans une ambiance conviviale, de partage et d’entraide.
        L’adhésion au fablab vous permet d’accéder à l’ensemble des machines et de bénéficier des différentes formations proposées.
        Pour votre première visite, nous vous invitons à prendre contact avec nous.</h2>
    </div>
  </section>

  <!-- Values Section -->
  <section id="values" class="values">
    <div class="container section-header" data-aos="fade-up" data-aos-delay="600">
      <div class="container">
        <div class="text-center">
          <h2>Nos formations</h2>
          <h3>Vous souhaitez apprendre à utiliser une machine ou des logiciels open source ?</h3>
        </div>
        <hr class="horizontal-line-black">
        <div class="row">
          <div class="col-md-6">
            <div class="py-5">
              <h3>Nous vous proposons des formations individuelles ou collectives sur différentes thématiques :</h3>
              <ul>
                <li>L’impression 3D : Zortrax – Raise3D – Up!</li>
                <li>La modélisation 3D : FreeCAD – Blender – Sculptris</li>
                <li>L’impression 2D : Rolland BN20</li>
                <li>La découpeuse laser : Trotec Speedy 400</li>
                <li>La vectorisation 2D : Inkscape</li>
                <li>L’électronique : Arduino – Raspberry Pi</li>
                <li>Le scan 3D : photogrammetrie Meshroom – Sense3D</li>
                <li>Programmation : C++ – scratch (Niveau1, initiation)</li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <div class="p-4">
              <img src="assets/img/img-form.jpg" alt="" class="custom-image-infos">
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="text-center">
          <h2>Nos ateliers</h2>
          <h3>Vous êtes animateur ou enseignant et vous souhaitez faire intervenir les makers du fablab ?</h3>
        </div>
        <hr class="horizontal-line-black">
        <h3>Nous proposons aux établissements scolaires ou organismes, des ateliers de sensibilisation et de découverte aux nouvelles technologies.
          Ces ateliers visent à sensibiliser le public, sur les différents potentiels des outils numériques et du faire soi même.
          A travers ces ateliers le public expérimente la fabrication par le numérique à travers la coopération et l’entraide.
          Ces ateliers sont à destination des écoliers, enfants, étudiants, demandeurs d’emploi, personnes âgées… Ils permettent à chacun, quel que soit son niveau, de découvrir ou redécouvrir son pouvoir de création !</h3>
        <div class="row mx-5">
          <div class="col-md-6">
            <div class="p-5 mx-5">
              <h3>Atelier de fabrication d’une main myoélectrique</h3>
              <ul>
                <li>Modélisation et impression 3D TinkerCad/Zortrax</li>
                <li>Électronique Arduino</li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <div class="p-4">
              <img src="assets/img/img-form2.jpg" alt="" class="custom-image-infos">
            </div>
          </div>
        </div>
        <div class="row mx-5">
          <div class="col-md-6 text-center">
            <div class="p-4">
              <img src="assets/img/img-form3.jpg" alt="" class="custom-image-infos">
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-5">
              <h3>Atelier d’initiation au pilotage de drones</h3>
              <ul>
                <li>E011</li>
                <li>Modélisation</li>
                <li>Pilotage</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row mx-5">
          <div class="col-md-6">
            <div class="p-5 mx-5">
              <h3>Atelier de programmation</h3>
              <ul>
                <li>Scratch</li>
                <li>Raspberry Pi</li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <div class="p-4">
              <img src="assets/img/img-form4.jpg" alt="" class="custom-image-infos">
            </div>
          </div>
        </div>
        <div class="row mx-5">
          <div class="col-md-6 text-center">
            <div class="p-4">
              <img src="assets/img/img-form5.jpg" alt="" class="custom-image-infos">
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-5">
              <h3>Atelier modélisation et impression 3D</h3>
              <ul>
                <li>TinkerCad</li>
                <li>FreeCAD</li>
                <li>Blender</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row mx-5">
          <div class="col-md-6">
            <div class="p-5 mx-5">
              <h3>Atelier vectorisation et découpe au laser</h3>
              <ul>
                <li>Trotec speedy 400</li>
                <li>Vectorisation Inkscape</li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <div class="p-4">
              <img src="assets/img/img-form6.jpg" alt="" class="custom-image-infos">
            </div>
          </div>
        </div>
      </div>
      <h3>L’ensemble des ateliers sont encadrés par la fabmanager accompagnée de jeunes volontaires en service civique.
        Pour des besoins spécifiques n’hésitez pas à nous contacter.</h3>
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
          </ul>
        </div>
        <div class="col-2 footer-links">
          <h4>Innofab</h4>
          <ul>
            <li><a href="tarifs.php">Nos tarifs</a></li>
            <li><a href="contact.php">Nous contacter</a></li>
            <li><a href="membres-fondateurs.php">Membres fondateurs</a></li>
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