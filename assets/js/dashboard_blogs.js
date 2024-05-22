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

function afficherPopup() {
  var popup = document.getElementById("popupForm");
  var overlay = document.getElementById("overlay");
  if (popup && overlay) {
    popup.classList.remove("hidden");
    overlay.classList.remove("hidden");
  } else {
    console.error(
      "Erreur : Élément 'popupForm' ou 'overlay' non trouvé dans le DOM !"
    );
  }
}

function fermerPopup() {
  var popup = document.getElementById("popupForm");
  var overlay = document.getElementById("overlay");
  if (popup && overlay) {
    popup.classList.add("hidden");
    overlay.classList.add("hidden");
  } else {
    console.error(
      "Erreur : Élément 'popupForm' ou 'overlay' non trouvé dans le DOM !"
    );
  }
}

// Variables globales pour stocker les images sélectionnées
var nouvelleImage1, nouvelleImage2, nouvelleImage3;

function afficherFormulaireModifier(
  id,
  nom,
  image1,
  petiteDescription,
  image2,
  description1,
  image3,
  description2
) {
  var form = document.createElement("form");
  form.innerHTML = `
        <div class="card">
            <div class="card-header">
                Formulaire de modification
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="titreBlog">Titre du blog:</label>
                    <input type="text" class="form-control" id="titreBlog" name="titre" value="${escapeHTML(
                      nom
                    )}" required>
                </div>
                <div class="form-group">
                    <label for="nouvelleImage1">Nouvelle Image 1:</label>
                    <input type="file" id="nouvelleImage1" name="nouvelleImage1" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="nouvellepetiteDescription">Nouvelle Petite Description:</label>
                    <textarea class="form-control" id="nouvellepetiteDescription" name="petiteDescription" rows="4" required>${escapeHTML(
                      petiteDescription
                    )}</textarea>
                </div>
                <div class="form-group">
                    <label for="nouvelleImage2">Nouvelle Image 2:</label>
                    <input type="file" id="nouvelleImage2" name="nouvelleImage2" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="nouvelleDescription1">Nouvelle Description 1:</label>
                    <textarea class="form-control" id="nouvelleDescription1" name="nouvelleDescription1" rows="4" required>${escapeHTML(
                      description1
                    )}</textarea>
                </div>
                <div class="form-group">
                    <label for="nouvelleImage3">Nouvelle Image 3:</label>
                    <input type="file" id="nouvelleImage3" name="nouvelleImage3" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="nouvelleDescription2">Nouvelle Description 2:</label>
                    <textarea class="form-control" id="nouvelleDescription2" name="nouvelleDescription2" rows="4" required>${escapeHTML(
                      description2
                    )}</textarea>
                </div>
                <input type="hidden" id="id_blog" name="id_blog" value="${escapeHTML(
                  id
                )}">
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

    // Attacher un gestionnaire d'événements change à chaque input de type fichier
    form
      .querySelector("#nouvelleImage1")
      .addEventListener("change", function (event) {
        nouvelleImage1 = event.target.files[0];
        console.log("Fichier sélectionné pour Image 1 :", nouvelleImage1);
      });
    form
      .querySelector("#nouvelleImage2")
      .addEventListener("change", function (event) {
        nouvelleImage2 = event.target.files[0];
        console.log("Fichier sélectionné pour Image 2 :", nouvelleImage2);
      });
    form
      .querySelector("#nouvelleImage3")
      .addEventListener("change", function (event) {
        nouvelleImage3 = event.target.files[0];
        console.log("Fichier sélectionné pour Image 3 :", nouvelleImage3);
      });
  } else {
    console.error("Erreur : Conteneur de la popup non trouvé !");
  }
}

function sauvegarderModification() {
  var id_blog = document.getElementById("id_blog").value;
  var nouveauTitre = document.getElementById("titreBlog").value;

  // Récupérer la nouvelle description
  var nouvellepetiteDescription = document.getElementById(
    "nouvellepetiteDescription"
  ).value;
  var nouvelleDescription1 = document.getElementById(
    "nouvelleDescription1"
  ).value;
  var nouvelleDescription2 = document.getElementById(
    "nouvelleDescription2"
  ).value;

  nouvellepetiteDescription = nouvellepetiteDescription.replace(/\r?\n/g, '\n');
  nouvelleDescription1 = nouvelleDescription1.replace(/\r?\n/g, '\n');
  nouvelleDescription2 = nouvelleDescription2.replace(/\r?\n/g, '\n');
  
  // Créer un objet FormData et ajouter les données du formulaire
  var formData = new FormData();
  formData.append("id_blog", id_blog);
  formData.append("nouveauTitre", nouveauTitre);
  formData.append("nouvellepetiteDescription", nouvellepetiteDescription);
  formData.append("nouvelleDescription1", nouvelleDescription1);
  formData.append("nouvelleDescription2", nouvelleDescription2);

  // Ajouter chaque nouvelle image sélectionnée au FormData
  if (nouvelleImage1) {
    console.log("Fichier sélectionné pour Image 1 :", nouvelleImage1);
    formData.append("nouvelleImage1", nouvelleImage1);
  }
  if (nouvelleImage2) {
    console.log("Fichier sélectionné pour Image 2 :", nouvelleImage2);
    formData.append("nouvelleImage2", nouvelleImage2);
  }
  if (nouvelleImage3) {
    console.log("Fichier sélectionné pour Image 3 :", nouvelleImage3);
    formData.append("nouvelleImage3", nouvelleImage3);
  }

  // Envoyer les données du formulaire via XMLHttpRequest
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../Serveur/modifier_blog.php");
  xhr.onload = function () {
    if (xhr.status === 200) {
      console.log("Modification réussie");
      // Recharger la page après la modification
      window.location.reload();
    } else {
      console.log("Erreur lors de la modification");
    }
  };
  xhr.send(formData); // Envoyer les données du formulaire avec FormData
}

// Fonction pour supprimer un blog
function supprimerBlog(id_blog) {
  if (confirm("Êtes-vous sûr de vouloir supprimer ce blog ?")) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../Serveur/supprimerblog.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Actualiser la page après la suppression
          window.location.reload();
        } else {
          console.error(xhr.responseText);
        }
      }
    };
    xhr.send("id_blog=" + id_blog);
  }
}
s;
// Fonction pour échapper les caractères HTML
function escapeHTML(html) {
  return html
    .replace(/&/g, "")
    .replace(/</g, "")
    .replace(/>/g, "")
    .replace(/"/g, "")
    .replace(/'/g, "");
}
