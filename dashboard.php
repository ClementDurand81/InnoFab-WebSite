<?php
// Initialisation de la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit;
}

// Vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Rediriger l'utilisateur vers la page d'accueil s'il n'est pas un administrateur
    header("Location: index.php");
    exit;
}

$nombre_de_connexions = 100;
$nombre_d_inscrits = 50;
$nombre_d_inscrits_en_attente = 20;

$dataLabels = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
$dataValues = [12, 19, 3, 17, 7, 3, 22];

$dataLabelsBlogs = ['Blog1', 'Blog 2', 'Blog 3', 'Blog 4', 'Blog 5'];
$dataValuesBlogs = [100, 200, 150, 300, 250];

$dataLabelsMachines = ['Machine 1', 'Machine 2', 'Machine 3', 'Machine 4', 'Machine 5'];
$dataValuesMachines = [500, 600, 700, 800, 900];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>
  <div class="sidebar">
    <h2>Menu</h2>
    <ul>
      <li><a href="index.php"><i class="fas fa-home"></i> Site</a></li>
      <li><a href="dashboard.php"><i class="fas fa-home"></i> Accueil</a></li>
      <li><a href="dashboard_utilisateur.php"><i class="fas fa-user"></i> Utilisateur</a></li>
      <li><a href="dashboard_blog.php"><i class="fas fa-blog"></i> Blog</a></li>
      <li><a href="dashboard_machines.php"><i class="fas fa-server"></i> Machines</a></li>
    </ul>
    <div class="user-actions">
      <a href="deconnexion.php">Se déconnecter</a>
    </div>
  </div>

  <div class="content">
    <div class="header">
      <h2>Tableau de bord</h2>
    </div>

    <div class="card-container"> <!-- Ajoutez un conteneur pour les cartes -->
      <!-- Première carte -->
      <div class="card">
        <div class="card-icon">
          <i class="fas fa-users"></i>
        </div>
        <div class="card-content">
          <h3>Utilisateurs</h3>
          <div class="chart-container user-chart-container">
            <canvas id="userChart" class="chart-canvas"></canvas>
          </div>
        </div>
      </div>

      <!-- Deuxième carte -->
      <div class="card">
        <div class="card-icon">
          <i class="fas fa-chart-line"></i>
        </div>
        <div class="card-content">
          <h3>Site</h3>
          <div class="chart-container stat-chart-container">
            <canvas id="statChart" class="chart-canvas"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="card-container"> <!-- Ajoutez un conteneur pour les cartes -->
      <!-- Première carte -->
      <div class="card">
        <div class="card-icon">
          <i class="fas fa-blog"></i>
        </div>
        <div class="card-content">
          <h3>Blog</h3>
          <div class="chart-container stat-chart-container">
            <canvas id="blogChart" class="chart-canvas"></canvas>
          </div>
        </div>
      </div>

      <!-- Deuxième carte -->
      <div class="card">
        <div class="card-icon">
          <i class="fas fa-server"></i>
        </div>
        <div class="card-content">
          <h3>Machines</h3>
          <div class="chart-container stat-chart-container">
            <canvas id="machineChart" class="chart-canvas"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    var nombre_d_inscrits = <?php echo $nombre_d_inscrits; ?>;
    var nombre_d_inscrits_en_attente = <?php echo $nombre_d_inscrits_en_attente; ?>;
    var dataLabels = <?php echo json_encode($dataLabels); ?>;
    var dataValues = <?php echo json_encode($dataValues); ?>;
    var dataLabelsMachines = <?php echo json_encode($dataLabelsMachines); ?>;
    var dataValuesMachines = <?php echo json_encode($dataValuesMachines); ?>;
    var dataLabelsBlogs = <?php echo json_encode($dataLabelsBlogs); ?>;
    var dataValuesBlogs = <?php echo json_encode($dataValuesBlogs); ?>;
  </script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="assets/js/graph.js"></script>
</body>

</html>