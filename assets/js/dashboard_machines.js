function afficherFormulaire() {
  document.getElementById("formulaire").classList.remove("hidden");
  document.getElementById("tableau").classList.add("hidden");
  document.getElementById("tableau2").classList.add("hidden");
  document.getElementById("popupForm").classList.add("hidden");
}

function afficherTableauModifier() {
  document.getElementById("tableau").classList.remove("hidden");
  document.getElementById("tableau2").classList.add("hidden");
  document.getElementById("formulaire").classList.add("hidden");
  document.getElementById("popupForm").classList.add("hidden");
}

function afficherTableauSupprimer() {
  document.getElementById("tableau2").classList.remove("hidden");
  document.getElementById("tableau").classList.add("hidden");
  document.getElementById("formulaire").classList.add("hidden");
  document.getElementById("popupForm").classList.add("hidden");
}

function afficherFormulaireModifier(id, nom, image, description) {
  var form = document.createElement("form");
  form.innerHTML = `
      <div class="card">
          <div class="card-header">
              Formulaire de modification
          </div>
          <div class="card-body">
              <div class="form-group">
                  <label for="titreMachine">Titre de la machine:</label>
                  <input type="text" class="form-control" id="titreMachine" name="titre" value="${nom}" required>
              </div>
              <div class="form-group">
                  <label for="nouvelleImage">Nouvelle Image:</label>
                  <input type="text" class="form-control" id="nouvelleImage" name="image" value="${image}" required>
              </div>
              <div class="form-group">
                  <label for="nouvelleDescription">Nouvelle Description:</label>
                  <textarea class="form-control" id="nouvelleDescription" name="description" rows="4" required>${description}</textarea>
              </div>
              <input type="hidden" id="id_machine" name="id_machine" value="${id}">
              <button type="button" class="btn btn-primary" onclick="sauvegarderModification()">Sauvegarder</button>
              <button type="button" class="btn btn-danger" onclick="fermerPopup()">Fermer</button>
          </div>
      </div>
  `;

  var popupContent = document.querySelector(".popup-content");
  if (popupContent) {
    popupContent.innerHTML = ""; // Nettoyer le contenu précédent
    popupContent.appendChild(form); // Ajouter le formulaire à la popup
    afficherPopup(); // Afficher la popup
    console.log("Formulaire de modification généré avec succès !");
  } else {
    console.error("Erreur : Conteneur de la popup non trouvé !");
  }
}

function afficherPopup() {
  var popup = document.getElementById("popupForm");
  if (popup) {
    popup.classList.remove("hidden"); // Utilisez remove pour supprimer la classe hidden
    overlay.classList.remove("hidden");
  } else {
    console.error("Erreur : Élément 'popupForm' non trouvé dans le DOM !");
  }
}

function fermerPopup() {
  var popup = document.getElementById("popupForm");
  if (popup) {
    popup.classList.add("hidden"); // Utilisez add pour ajouter la classe hidden
    overlay.classList.add("hidden");
  } else {
    console.error("Erreur : Élément 'popupForm' non trouvé dans le DOM !");
  }
}

function sauvegarderModification() {
  var id_machine = document.getElementById("id_machine").value;
  var nouveauTitre = document.getElementById("titreMachine").value;
  var nouvelleImage = document.getElementById("nouvelleImage").value;
  var nouvelleDescription = document.getElementById(
    "nouvelleDescription"
  ).value;

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "modifier_machine.php");
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      console.log("Modification réussie");
      // Recharger la page après la modification
      window.location.reload();
    } else {
      console.log("Erreur lors de la modification");
    }
  };
  xhr.send(
    "id_machine=" +
      encodeURIComponent(id_machine) +
      "&nouveauTitre=" +
      encodeURIComponent(nouveauTitre) +
      "&nouvelleImage=" +
      encodeURIComponent(nouvelleImage) +
      "&nouvelleDescription=" +
      encodeURIComponent(nouvelleDescription)
  );
}
