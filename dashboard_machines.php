<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machines</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script>
        // Récupérer l'URL actuelle de la page
        var currentURL = window.location.href;

        // Vérifier si l'URL contient un paramètre de succès
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            var success = urlParams.get('success');
            if (success === 'true') {
                // Afficher la popup de succès
                alert('Machine ajoutée avec succès !');
            } else {
                // Afficher la popup d'erreur
                alert('Erreur lors de l\'ajout de la machine.');
            }
        }
    </script>
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

        <div id="tableau" class="hidden">
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
                    <tr onclick="afficherFormulaireModifier(5, 'Dupont', 'Marie', 'marie.dupont@example.com')">
                        <td>5</td>
                        <td>Dupont</td>
                        <td>Marie</td>
                        <td>marie.dupont@example.com</td>
                        <td><button class="accept-button" onclick="accepterUtilisateur()">Accepter</button> <button class="reject-button" onclick="refuserUtilisateur()">Refuser</button></td>
                    </tr>
                    <tr onclick="afficherFormulaireModifier(6, 'Leclerc', 'Luc', 'luc.leclerc@example.com')">
                        <td>6</td>
                        <td>Leclerc</td>
                        <td>Luc</td>
                        <td>luc.leclerc@example.com</td>
                        <td><button class="accept-button" onclick="accepterUtilisateur()">Accepter</button> <button class="reject-button" onclick="refuserUtilisateur()">Refuser</button></td>
                    </tr>
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