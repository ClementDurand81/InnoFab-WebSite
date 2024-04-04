<?php
// Inclure la connexion à la base de données
include "bdd.php";

// Récupérer toutes les machines de la base de données
$sql = "SELECT * FROM machines";
$stmt = $bdd->query($sql);
$machines = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machines</title>
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
            <h2>Machines</h2>
        </div>
        <div class="options-container">
            <label>
                <input type="radio" name="userOption" value="afficher" onclick="afficherFormulaire()">
                <h3>Ajouter</h3>
            </label>
            <label>
                <input type="radio" name="userOption" value="accepter" onclick="afficherTableauModifier()">
                <h3>Modifier</h3>
            </label>
            <label>
                <input type="radio" name="userOption" value="supprimer" onclick="afficherTableauSupprimer()">
                <h3>Supprimer</h3>
            </label>
        </div>
        <br>
        <div id="formulaire" class="hidden">
            <form action="ajouter_machine.php" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="nom">Nom de la machine:</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div>
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>
                <div>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                <button type="submit">Ajouter</button>
            </form>
        </div>

        <!-- Structure HTML pour le tableau -->
        <div id="tableau" class="hidden">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($machines as $machine) : ?>
                        <tr>
                            <td><?php echo $machine['id_machines']; ?></td>
                            <td><?php echo $machine['Titre']; ?></td>
                            <td><img src="<?php echo $machine['Image']; ?>" alt="<?php echo $machine['Titre']; ?>" style="width: 100px;"></td>
                            <td><?php echo $machine['Description']; ?></td>
                            <td><button class="btn btn-modifier" onclick="afficherFormulaireModifier('<?php echo $machine['id_machines']; ?>', '<?php echo $machine['Titre']; ?>', '<?php echo $machine['Image']; ?>', '<?php echo $machine['Description']; ?>')">Modifier</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Structure HTML pour la carte pop-up -->
        <div id="popupForm" class="popup hidden">
            <div class="popup-content">
                <div id="formulaireModifier" class="hidden">
                    <!-- Le formulaire sera injecté ici -->
                </div>
            </div>
        </div>

        <div id="overlay" class="overlay hidden"></div>


        <div id="tableau2" class="hidden">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>5</td>
                        <td>Dupont</td>
                        <td>Marie</td>
                        <td>marie.dupont@example.com</td>
                        <td><button onclick="supprimerUtilisateur()">Supprimer</button></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Leclerc</td>
                        <td>Luc</td>
                        <td>luc.leclerc@example.com</td>
                        <td><button onclick="supprimerUtilisateur()">Supprimer</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="assets/js/dashboard_machines.js"></script>
</body>

</html>