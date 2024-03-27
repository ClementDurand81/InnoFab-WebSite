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