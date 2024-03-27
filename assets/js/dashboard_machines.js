function afficherFormulaire() {
    document.getElementById("formulaire").classList.remove("hidden");
    document.getElementById("tableau").classList.add("hidden");
    document.getElementById("tableau2").classList.add("hidden");
}

function afficherTableauModifier() {
    document.getElementById("tableau").classList.remove("hidden");
    document.getElementById("tableau2").classList.add("hidden");
    document.getElementById("formulaire").classList.add("hidden");

    var rows = document.querySelectorAll("#tableau table tbody tr");
    rows.forEach(function(row) {
        row.addEventListener("click", function() {
            afficherFormulaireModifier(row);
        });
    });
}

function afficherTableauSupprimer() {
    document.getElementById("tableau2").classList.remove("hidden");
    document.getElementById("tableau").classList.add("hidden");
    document.getElementById("formulaire").classList.add("hidden");
}

function afficherFormulaireModifier(id, nom, prenom, email) {
    var form = document.createElement("form");
    form.innerHTML = `
        <div>
            <label for="nom">Nom de la machine:</label>
            <input type="text" id="nom" name="nom" value="${nom}">
        </div>
        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="${prenom}">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="${email}">
        </div>
        <input type="hidden" id="id" name="id" value="${id}">
        <button type="button" onclick="validerModification()">Valider</button>
    `;

    var container = document.getElementById("formulaire");
    container.innerHTML = "";
    container.appendChild(form);
}

function validerModification() {
    var id = document.getElementById("id").value;
    var nom = document.getElementById("nom").value;
    var prenom = document.getElementById("prenom").value;
    var email = document.getElementById("email").value;

    // Envoyer les données modifiées à votre backend (PHP)
    // Vous pouvez utiliser AJAX pour cela
    // Exemple d'utilisation de fetch :
    fetch('modifier_machine.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id: id,
            nom: nom,
            prenom: prenom,
            email: email
        }),
    })
    .then(response => response.json())
    .then(data => {
        // Traiter la réponse du serveur
        console.log('Réponse du serveur :', data);
        // Actualiser la page ou effectuer d'autres actions si nécessaire
    })
    .catch((error) => {
        console.error('Erreur :', error);
    });
}