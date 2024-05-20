<?php
// Inclure la connexion à la base de données
include "../Serveur/bdd.php";

// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['user_id'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: ../login.php");
    exit;
}

// Vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Rediriger l'utilisateur vers la page d'accueil s'il n'est pas un administrateur
    header("Location: ../index.php");
    exit;
}

// Récupérer toutes les machines de la base de données
$sql = "SELECT * FROM blogs";
$stmt = $bdd->query($sql);
if ($stmt === false) {
    // Erreur lors de l'exécution de la requête SQL
    http_response_code(500);
    exit("Erreur lors de la récupération des données des blogs.");
}
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="../index.php"><i class="fas fa-home"></i> Site</a></li>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Accueil</a></li>
            <li><a href="dashboard_utilisateur.php"><i class="fas fa-user"></i> Utilisateur</a></li>
            <li><a href="dashboard_blog.php"><i class="fas fa-blog"></i> Blog</a></li>
            <li><a href="dashboard_machines.php"><i class="fas fa-server"></i> Machines</a></li>
        </ul>
        <div class="user-actions">
            <a href="../Serveur/deconnexion.php">Se déconnecter</a>
        </div>
    </div>

    <div class="content">
        <div class="header">
            <h2>Blogs</h2>
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
            <form action="../Serveur/ajouter_blog.php" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="nom">Titre du blog :</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div>
                    <label for="image1">Image du blog :</label>
                    <input type="file" id="image1" name="image1" accept="image/*" required>
                </div>
                <div>
                    <label for="petiteDescription">Petite Description :</label>
                    <textarea id="petiteDescription" name="petiteDescription" rows="4" required></textarea>
                </div>
                <div>
                    <label for="image2">Image 1 :</label>
                    <input type="file" id="image2" name="image2" accept="image/*" required>
                </div>
                <div>
                    <label for="description1">Description 1:</label>
                    <textarea id="description1" name="description1" rows="4" required></textarea>
                </div>
                <div>
                    <label for="image3">Image 2 :</label>
                    <input type="file" id="image3" name="image3" accept="image/*" required>
                </div>
                <div>
                    <label for="description2">Description 2:</label>
                    <textarea id="description2" name="description2" rows="4" required></textarea>
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
                        <th>Titre</th>
                        <th>Image blog</th>
                        <th>Petite Description</th>
                        <th>Image 1</th>
                        <th>Description 1</th>
                        <th>Image 2</th>
                        <th>Description 2</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($blogs as $blog) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($blog['id_blog']); ?></td>
                            <td><?php echo htmlspecialchars($blog['Titre']); ?></td>
                            <td><img src="../<?php echo htmlspecialchars($blog['Image_1']); ?>" alt="<?php echo htmlspecialchars($blog['Titre']); ?>" style="width: 100px;"></td>
                            <td><?php echo htmlspecialchars($blog['petiteDescription']); ?></td>
                            <td><img src="../<?php echo htmlspecialchars($blog['Image_2']); ?>" alt="<?php echo htmlspecialchars($blog['Titre']); ?>" style="width: 100px;"></td>
                            <td><?php echo htmlspecialchars($blog['Description_1']); ?></td>
                            <td><img src="../<?php echo htmlspecialchars($blog['Image_3']); ?>" alt="<?php echo htmlspecialchars($blog['Titre']); ?>" style="width: 100px;"></td>
                            <td><?php echo htmlspecialchars($blog['Description_2']); ?></td>
                            <td>
                                <button class="btn btn-modifier" onclick="afficherFormulaireModifier(
                        '<?php echo htmlspecialchars($blog['id_blog']); ?>', 
                        '<?php echo htmlspecialchars($blog['Titre']); ?>', 
                        '<?php echo htmlspecialchars($blog['Image_1']); ?>', 
                        '<?php echo htmlspecialchars($blog['petiteDescription']); ?>', 
                        '<?php echo htmlspecialchars($blog['Image_2']); ?>', 
                        '<?php echo htmlspecialchars($blog['Description_1']); ?>', 
                        '<?php echo htmlspecialchars($blog['Image_3']); ?>', 
                        '<?php echo htmlspecialchars($blog['Description_2']); ?>'
                    )">Modifier</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="popupForm" class="popup hidden">
            <div class="popup-content">
                <div id="formulaireModifier" class="formulaire-modifier">
                    <!-- Le formulaire sera injecté ici -->
                </div>
            </div>
        </div>

        <div id="overlay" class="overlay hidden" onclick="fermerPopup()"></div>

        <div id="tableau2" class="hidden">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Image blog</th>
                        <th>Petite Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($blogs as $blog) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($blog['id_blog']); ?></td>
                            <td><?php echo htmlspecialchars($blog['Titre']); ?></td>
                            <td><img src="../<?php echo htmlspecialchars($blog['Image_1']); ?>" alt="<?php echo htmlspecialchars($blog['Titre']); ?>" style="width: 100px;"></td>
                            <td><?php echo htmlspecialchars($blog['petiteDescription']); ?></td>
                            <td><button class="btn btn-modifier" onclick="supprimerBlog('<?php echo htmlspecialchars($blog['id_blog']); ?>')">Supprimer</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../assets/js/dashboard_blogs.js"></script>
</body>

</html>