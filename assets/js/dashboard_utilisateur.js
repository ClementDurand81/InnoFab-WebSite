function afficherTableau() {
    document.getElementById("tableau").classList.remove("hidden");
    document.getElementById("tableau2").classList.add("hidden");
    document.getElementById("tableau3").classList.add("hidden");
}

function afficherTableauAccepter() {
    document.getElementById("tableau2").classList.remove("hidden");
    document.getElementById("tableau").classList.add("hidden");
    document.getElementById("tableau3").classList.add("hidden");
}

function afficherTableauSupprimer() {
    document.getElementById("tableau3").classList.remove("hidden");
    document.getElementById("tableau2").classList.add("hidden");
    document.getElementById("tableau").classList.add("hidden");
}

function supprimerUtilisateur(userId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        // Envoi d'une requête AJAX pour supprimer l'utilisateur
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "supprimerutilisateur.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Actualiser la page après la suppression
                    window.location.reload();
                } else {
                    console.error(xhr.responseText);
                }
            }
        };
        xhr.send("userId=" + userId);
    }
}

// Fonction pour ajouter un utilisateur
function ajouterUtilisateur(userId) {
    if (confirm("Êtes-vous sûr de vouloir ajouter cet utilisateur ?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "ajouterutilisateur.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Actualiser la page après l'ajout
                    window.location.reload();
                } else {
                    console.error(xhr.responseText);
                }
            }
        };
        xhr.send("userId=" + userId);
    }
}

// Fonction pour supprimer un utilisateur
function supprimerUtilisateur(userId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "supprimerutilisateur.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Actualiser la page après la suppression
                    window.location.reload();
                } else {
                    console.error(xhr.responseText);
                }
            }
        };
        xhr.send("userId=" + userId);
    }
}