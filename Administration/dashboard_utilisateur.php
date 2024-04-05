<?php
// Connexion à la base de données
require_once('../Serveur/bdd.php');

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

// Effectuer la requête SQL pour sélectionner tous les utilisateurs validés
$stmt = $bdd->prepare("SELECT id_utilisateur, Nom, Prenom, email FROM utilisateur WHERE valide = 1");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateur</title>
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
            <h2>Utilisateur</h2>
        </div>
        <div class="options-container">
            <label>
                <input type="radio" name="userOption" value="afficher" onclick="afficherTableau()">
                <h3>Afficher</h3>
            </label>
            <label>
                <input type="radio" name="userOption" value="accepter" onclick="afficherTableauAccepter()">
                <h3>En Attente</h3>
            </label>
            <label>
                <input type="radio" name="userOption" value="supprimer" onclick="afficherTableauSupprimer()">
                <h3>Supprimer</h3>
            </label>
        </div>
        <br>

        <!-- Tableau pour afficher les utilisateurs -->
        <div id="tableau" class="hidden">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id_utilisateur']); ?></td>
                            <td><?php echo htmlspecialchars($user['Nom']); ?></td>
                            <td><?php echo htmlspecialchars($user['Prenom']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="tableau2" class="hidden">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Actions</th> <!-- Nouvelle colonne pour les boutons -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Effectuer une nouvelle requête SQL pour sélectionner les utilisateurs dont la section valide est à 0
                    $stmt2 = $bdd->prepare("SELECT id_utilisateur, Nom, Prenom, email FROM utilisateur WHERE valide = 0");
                    $stmt2->execute();
                    $users2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach ($users2 as $user2) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user2['id_utilisateur']); ?></td>
                            <td><?php echo htmlspecialchars($user2['Nom']); ?></td>
                            <td><?php echo htmlspecialchars($user2['Prenom']); ?></td>
                            <td><?php echo htmlspecialchars($user2['email']); ?></td>
                            <td>
                                <!-- Bouton "Ajouter" -->
                                <button onclick="ajouterUtilisateur(<?php echo htmlspecialchars($user2['id_utilisateur']); ?>)">Ajouter</button>

                                <!-- Bouton "Supprimer" -->
                                <button onclick="supprimerUtilisateur(<?php echo htmlspecialchars($user2['id_utilisateur']); ?>)">Supprimer</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="tableau3" class="hidden">
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
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id_utilisateur']); ?></td>
                            <td><?php echo htmlspecialchars($user['Nom']); ?></td>
                            <td><?php echo htmlspecialchars($user['Prenom']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><button onclick="supprimerUtilisateur(<?php echo htmlspecialchars($user['id_utilisateur']); ?>)">Supprimer</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../assets/js/dashboard_utilisateur.js"></script>
</body>

</html>