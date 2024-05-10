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
      <h5 class="mt-5 pt-4 text-center">Politique de confidentialité</h5>
      <hr class="horizontal-line">
    </div>
  </section>

  <!-- Values Section -->
  <section id="values" class="values">
    <div class="container section-header" data-aos="fade-up" data-aos-delay="600">
      <h4><strong>Politique de confidentialité d'Innofab</strong></h4>
      <p><strong>Dernière mise à jour : 29/01/2024</strong></p>
      <p>Nous vous remercions de visiter innofab.fr !</p>
      <p>La présente Politique de confidentialité décrit comment nous collectons, utilisons et partageons vos informations personnelles lorsque vous visitez notre site web.</p>
      <p>En utilisant innofab.fr, vous consentez à la collecte et à l'utilisation d'informations conformément à la présente politique.</p>
      <p><strong>Informations que nous collectons</strong></p>
      <p>Nous pouvons collecter des informations personnelles identifiables telles que votre nom, votre adresse e-mail, et d'autres informations que vous choisissez de fournir volontairement lorsque vous utilisez notre site.</p>
      <p><strong>Comment nous utilisons vos informations</strong></p>
      <p>Nous utilisons les informations collectées pour diverses finalités, notamment pour vous fournir nos services, améliorer et personnaliser votre expérience sur innofab.fr, et communiquer avec vous.</p>
      <p><strong>Divulgation des informations</strong></p>
      <p>Nous ne vendons ni ne louons vos informations personnelles à des tiers sans votre consentement. Cependant, nous pouvons partager vos informations avec des partenaires de confiance pour nous aider à exploiter notre site et à vous fournir nos services.</p>
      <p><strong>Liens vers d'autres sites</strong></p>
      <p>Notre site peut contenir des liens vers des sites tiers. Nous ne sommes pas responsables des pratiques de confidentialité de ces sites. Nous vous encourageons à consulter les politiques de confidentialité de tout site que vous visitez.</p>
      <p><strong>Quelles sont les durées de conservation des données ?</strong></p>
      <p><strong>Règles générales</strong></p>
      <p>Innofab conserve les données à caractère personnel pendant une durée qui n’excède pas la durée nécessaire aux finalités pour lesquelles elles sont collectées, conformément aux dispositions de la loi du 6 janvier 1978 modifiée et du RGPD.</p>
      <p>Les données peuvent être conservées ultérieurement dans les cas suivants lorsque la conservation est nécessaire :</p>
      <ul>
        <li>À l’exercice du droit à la liberté d’expression et d’information,</li>
        <li>Au respect d’une obligation légale,</li>
        <li>À l’exécution d’une mission d’intérêt public ou relevant de l’exercice de l’autorité publique dont est investi le responsable du traitement,</li>
        <li>Pour des motifs d’intérêt public dans le domaine de la santé publique,</li>
        <li>À des fins archivistiques dans l’intérêt public,</li>
        <li>À des fins de recherche scientifique ou historique ou à des fins statistiques,</li>
        <li>Ou à la constatation, à l’exercice ou à la défense de droits en justice.</li>
      </ul>
      <p>Les critères pour déterminer les durées de conservation sont les suivants :</p>
      <ul>
        <li>Les dispositions légales ou règlementaires,</li>
        <li>La doctrine et la jurisprudence des autorités de contrôles,</li>
        <li>Les références sectorielles.</li>
      </ul>
      <p><strong>Gestion commerciale</strong></p>
      <p>Vos données sont conservées pour la durée de la relation contractuelle et selon les durées de prescription relatives à la conservation ou à la protection des droits du responsable de traitement.</p>
      <p><strong>Gestion des opérations commerciales</strong></p>
      <p>Les données sont conservées jusqu’au retrait du consentement ou 3 ans à compter du dernier contact. Elles peuvent également être conservées :</p>
      <ul>
        <li>Pour une durée de 3 ans à compter du dernier contact que les personnes auxquelles elles se rapportent ont eu avec notre société,</li>
        <li>Après l’exécution du contrat, en archivage intermédiaire, pour se constituer une preuve en cas de contentieux et dans la limite du délai de prescription applicable.</li>
      </ul>
      <p>Les données du compte client, créé par ce dernier, ont vocation à être conservées jusqu’à la suppression du compte par l’utilisateur. Toutefois, le compte pourra être considéré comme inactif à défaut d’utilisation pendant 2 ans et pourra faire l’objet d’une suppression.</p>
      <p><strong>Gestion des droits des personnes</strong></p>
      <p>Lorsqu’une personne exerce son droit d’opposition à recevoir de la prospection, afin de garantir son effectivité, les informations permettant de prendre en compte ce droit sont conservées au minimum 3 ans à compter de l’exercice du droit.</p>
      <p><strong>Sécurité</strong></p>
      <p>Le responsable de traitement met en œuvre les mesures techniques et organisationnelles appropriées afin de garantir un niveau de sécurité adapté au risque compte tenu de l’état des connaissances, des coûts de mise en œuvre et de la nature, de la portée, du contexte et des finalités du traitement ainsi que des risques, dont le degré de probabilité et de gravité varie, pour les droits et libertés des personnes. Lors de l’évaluation du niveau de sécurité approprié, il est tenu compte en particulier des risques que présente le traitement, résultant notamment de la destruction, de la perte, de l’altération, de la divulgation non autorisée de données à caractère personnel transmises, conservées ou traitées d’une autre manière, ou de l’accès non autorisé à de telles données, de manière accidentelle ou illicite.</p>
      <p><strong>Droits des personnes / Vos droits</strong></p>
      <p>Les personnes concernées disposent des droits suivants, qu’ils exercent dans les conditions prévues par le RGPD :</p>
      <ul>
        <li>Droit d’opposition, de retirer à tout moment leur consentement. Lorsque le traitement de vos données à caractère personnel est fondé sur le consentement, vous avez le droit de retirer votre consentement à tout moment sans porter atteinte à la licéité du traitement fondé sur le consentement effectué avant le retrait de celui-ci.</li>
        <li>Droit d’accès aux données à caractère personnel vous concernant (Article 15 du RGPD)</li>
        <li>Droit de rectification des données les concernant si elles sont inexactes (Article 16 du RGPD)</li>
        <li>Droit d’effacement des données qui les concernent sous réserve des conditions d’exercice de ce droit en application des dispositions de l’article 17 du RGPD</li>
        <li>Droit à la limitation du traitement (Article 18 du RGPD)</li>
        <li>Droit à la portabilité des données (Article 20 du RGPD)</li>
        <li>Droit d’opposition (Article 21 du RGPD)</li>
        <li>Droit de définir des directives relatives au sort de vos données à caractère personnel (conservation, effacement et communication des données) après votre décès (Article 85 de la loi Informatique et Libertés modifiée)</li>
        <li>Droit d’introduire une réclamation auprès d’une autorité de contrôle (Article 104.4 de la loi Informatique et Libertés modifiée)</li>
        <li>Décision automatisée. La personne concernée a le droit de ne pas faire l’objet d’une décision fondée exclusivement sur un traitement automatisé, y compris le profilage, produisant des effets juridiques la concernant ou l’affectant de manière significative de façon similaire. La personne concernée a le droit d’obtenir une intervention humaine de la part du responsable du traitement, d’exprimer son point de vue et de contester la décision.</li>
      </ul>
      <p>Consultez le site <strong><a href="https://www.cnil.fr/" style="color:black;">cnil.fr</a></strong> pour plus d’informations sur vos droits.</p>
      <p>Ces droits peuvent être exercés directement auprès du responsable de traitement.</p>
      <p><strong>Procédons-nous à des transferts de données à l’étranger ?</strong></p>
      <p>Vos données ne sont pas transférées dans des pays tiers et restent hébergées au sein de l’Union européenne.</p>
      <p>En ce qui concerne les fonctionnalités liées à l’utilisation des réseaux sociaux, vos publications sont susceptibles d’être accessibles hors de l’Union européenne. Nous vous invitons à consulter la politique de gestion des données des réseaux concernés.</p>
      <p><strong>Modifications de la Politique de Confidentialité</strong></p>
      <p>Nous nous réservons le droit de mettre à jour cette politique de confidentialité à tout moment. Nous vous recommandons de consulter régulièrement cette page pour prendre connaissance des éventuelles modifications.</p>
      <p><strong>Contactez-nous</strong></p>
      <p>Si vous avez des questions concernant cette politique de confidentialité, veuillez nous contacter à <strong>fabmanager@innofab.fr</strong>.</p>
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
            <p><i class="bi bi-envelope"></i> : fabmanager@innofab.fr</p>
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