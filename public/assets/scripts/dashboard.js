let fieldsetReservation = document.getElementById("reservation");
let fieldsetOptions = document.getElementById("options");

let choixJour1 = document.getElementById("choixJour1");
let choixJour2 = document.getElementById("choixJour2");
let choixJour3 = document.getElementById("choixJour3");
let choixJour12 = document.getElementById("choixJour12");
let choixJour23 = document.getElementById("choixJour23");

let choixJour1reduit = document.getElementById("choixJour1reduit");
let choixJour2reduit = document.getElementById("choixJour2reduit");
let choixJour3reduit = document.getElementById("choixJour3reduit");
let choixJour12reduit = document.getElementById("choixJour12reduit");
let choixJour23reduit = document.getElementById("choixJour23reduit");

//Par défaut afficher seulement la section "réservation"
fieldsetReservation.style.display = "block";
fieldsetOptions.style.display = "none";

//Gestion d'évènements BOUTON SUIVANT N°1
let btnSuivant1 = document.getElementById("btnSuivant1");

btnSuivant1.addEventListener("click", () => {
  // Validez la partie 1 avant de passer à la section suivante
  if (validerPartie1()) {
    // Si la validation réussit, passez à la section suivante
    fieldsetReservation.style.display = "none";
    fieldsetOptions.style.display = "block";
    if (parseInt(document.getElementById("nombrePlaces").value, 10) >= 1) {
      alertOption.textContent = "";
    }
    alertOption.textContent = "";
  } else {
    // Si la validation échoue, affichez une alerte et empêchez la transition
    alertOption.textContent = "Choisissez un pass";
  }
});

function validerPartie1() {
  let auMoinsUnPassCoche =
    choixJour1.checked ||
    choixJour2.checked ||
    choixJour3.checked ||
    choixJour12.checked ||
    choixJour23.checked ||
    choixJour1reduit.checked ||
    choixJour2reduit.checked ||
    choixJour3reduit.checked ||
    choixJour12reduit.checked ||
    choixJour23reduit.checked ||
    pass3joursCheckbox.checked ||
    pass3joursReduitCheckbox.checked;

  let nombrePlacesValide =
    parseInt(document.getElementById("nombrePlaces").value, 10) >= 1;

  // If the conditions are met, clear the alert
  if (auMoinsUnPassCoche && nombrePlacesValide) {
    alertOption.textContent = "";
  }

  // Return true if validation succeeds, otherwise false
  return auMoinsUnPassCoche && nombrePlacesValide;
}

//Gestion d'évènements pour BOUTON SUIVANT N°2
document.addEventListener("DOMContentLoaded", function () {
  // Déclaration des variables ici
  let radioEnfantsOui = document.getElementById("enfantsOui");
  let radioEnfantsNon = document.getElementById("enfantsNon");

  // Ajout du gestionnaire d'événements

  // Fonction pour valider la partie 1
  function validerPartie2() {
    // Ajoutez vos conditions de validation ici
    let reponseEnfants =
      radioEnfantsOui.value === "Oui" || radioEnfantsNon.value === "Non";
    // Retourne true si la validation réussit, sinon false
    return reponseEnfants;
  }
});

//Au clic sur le bouton précédent on revient sur la section réservation
let btnPrecedent = document.getElementById("btnPrecedent");

btnPrecedent.addEventListener("click", () => {
  fieldsetReservation.style.display = "block";
  fieldsetOptions.style.display = "none";
});

//Au clic sur le 2ème bouton précédent on revient sur la section options

//Afficher le choix de la date pour le pass 1 jour
let pass1jourCheckbox = document.getElementById("pass1jour");
let pass1jourDateSection = document.getElementById("pass1jourDate");

pass1jourCheckbox.addEventListener("change", choixDate1jour);

function choixDate1jour() {
  pass1jourDateSection.style.display = pass1jourCheckbox.checked
    ? "block"
    : "none";
}

//Masquer les dates des PASS TARIFS NORMAUX si les autres PASS sont sélectionnés
let pass2joursCheckbox = document.getElementById("pass2jours");
let pass3joursCheckbox = document.getElementById("pass3jours");
let pass2joursDateSection = document.getElementById("pass2joursDate");

pass1jourCheckbox.addEventListener("change", updateDateSection);
pass2joursCheckbox.addEventListener("change", updateDateSection);
pass3joursCheckbox.addEventListener("change", updateDateSection);

function updateDateSection() {
  if (pass2joursCheckbox.checked || pass3joursCheckbox.checked) {
    pass1jourDateSection.style.display = "none";
  } else {
    pass1jourDateSection.style.display = "block";
  }
  if (pass1jourCheckbox.checked || pass3joursCheckbox.checked) {
    pass2joursDateSection.style.display = "none";
  } else {
    pass2joursDateSection.style.display = "block";
  }
}

//Masquer les dates des PASS TARIFS REDUITS si les autres PASS sont sélectionnés
let pass1jourReduitCheckbox = document.getElementById("pass1jourreduit");
let pass2joursReduitCheckbox = document.getElementById("pass2joursreduit");
let pass3joursReduitCheckbox = document.getElementById("pass3joursreduit");
let pass1jourReduitSection = document.getElementById("pass1jourDateReduit");
let pass2joursReduitSection = document.getElementById("pass2joursDateReduit");

pass1jourReduitCheckbox.addEventListener("change", updateDateSectionReduit);
pass2joursReduitCheckbox.addEventListener("change", updateDateSectionReduit);
pass3joursReduitCheckbox.addEventListener("change", updateDateSectionReduit);

function updateDateSectionReduit() {
  if (pass2joursReduitCheckbox.checked || pass3joursReduitCheckbox.checked) {
    pass1jourReduitSection.style.display = "none";
  } else {
    pass1jourReduitSection.style.display = "block";
  }
  if (pass1jourReduitCheckbox.checked || pass3joursReduitCheckbox.checked) {
    pass2joursReduitSection.style.display = "none";
  } else {
    pass2joursDateSection.style.display = "block";
  }
}

//Afficher le choix de date pour le pass 2 jours
function choixDate2jours() {
  let pass2joursCheckbox = document.getElementById("pass2jours");
  let pass2joursDateSection = document.getElementById("pass2joursDate");

  pass2joursDateSection.style.display = pass2joursCheckbox.checked
    ? "block"
    : "none";
}

//Afficher ou masquer les tarifs réduits
function afficherMasquerTarifsReduits() {
  let checkboxTarifReduit = document.getElementById("tarifReduit");
  let tarifsReduitsSection = document.getElementById("tarifsReduits");
  let tarifsNormauxSection = document.getElementById("tarifsNormaux");

  if (checkboxTarifReduit.checked) {
    pass1jourCheckbox.checked = false;
    pass2joursCheckbox.checked = false;
    pass3joursCheckbox.checked = false;
    // choixJour1.checked = false;
    // choixJour2.checked = false;
    // choixJour3.checked = false;
    // choixJour12.checked = false;
    // choixJour23.checked = false;

    tarifsReduitsSection.style.display = "block";
    tarifsNormauxSection.style.display = "none";
  } else {
    pass1jourReduitCheckbox.checked = false;
    pass2joursReduitCheckbox.checked = false;
    pass3joursReduitCheckbox.checked = false;
    // choixJour1reduit.checked = false;
    // choixJour2reduit.checked = false;
    // choixJour3reduit.checked = false;
    // choixJour12reduit.checked = false;
    // choixJour23reduit.checked = false;

    tarifsReduitsSection.style.display = "none";
    tarifsNormauxSection.style.display = "block";
  }
}

//Afficher le choix des jours PASS 1 JOUR REDUIT
function choixDate1jourReduit() {
  let checkboxPass1jourReduit = document.getElementById("pass1jourreduit");
  let pass1jourDateSection = document.getElementById("pass1jourDateReduit");

  pass1jourDateSection.style.display = checkboxPass1jourReduit.checked
    ? "block"
    : "none";
}

//Afficher le choix des jours PASS 2 JOURS REDUIT
function choixDate2joursReduit() {
  let checkboxPass2joursReduit = document.getElementById("pass2joursreduit");
  let pass2joursDateSection = document.getElementById("pass2joursDateReduit");

  pass2joursDateSection.style.display = checkboxPass2joursReduit.checked
    ? "block"
    : "none";
}

//Cocher automatiquement "TENTE 3 NUITS" si les boutons des 3 nuits sont cochées
function cocherTente3nuits() {
  var tenteNuit1Checked = document.getElementById("tenteNuit1").checked;
  var tenteNuit2Checked = document.getElementById("tenteNuit2").checked;
  var tenteNuit3Checked = document.getElementById("tenteNuit3").checked;
  var tente3NuitsButton = document.getElementById("tente3Nuits");

  if (tenteNuit1Checked && tenteNuit2Checked && tenteNuit3Checked) {
    // Si les trois premiers sont cochés, cochez le bouton "tente3Nuits" et décochez les trois premiers
    tente3NuitsButton.checked = true;
    document.getElementById("tenteNuit1").checked = false;
    document.getElementById("tenteNuit2").checked = false;
    document.getElementById("tenteNuit3").checked = false;
  }
  //Si le bouton "tente3Nuits" est coché désactiver les options précédentes
  if (
    tente3NuitsButton.checked &&
    (tenteNuit1.checked || tenteNuit2.checked || tenteNuit3.checked)
  ) {
    // Si c'est le cas, désélectionnez automatiquement les options précédentes
    tenteNuit1.checked = false;
    tenteNuit2.checked = false;
    tenteNuit3.checked = false;
  }
}

// Fonction pour cocher automatiquement "VAN 3 NUITS" si les boutons des 3 nuits sont cochés
function cocherVan3nuits() {
  var vanNuit1Checked = document.getElementById("vanNuit1").checked;
  var vanNuit2Checked = document.getElementById("vanNuit2").checked;
  var vanNuit3Checked = document.getElementById("vanNuit3").checked;
  var van3NuitsButton = document.getElementById("van3Nuits");

  if (vanNuit1Checked && vanNuit2Checked && vanNuit3Checked) {
    // Si les trois premiers sont cochés, cochez le bouton "van3Nuits" et décochez les trois premiers
    van3NuitsButton.checked = true;
    document.getElementById("vanNuit1").checked = false;
    document.getElementById("vanNuit2").checked = false;
    document.getElementById("vanNuit3").checked = false;
  }
  //Si le bouton "van3Nuits" est coché désactiver les options précédentes
  if (
    van3NuitsButton.checked &&
    (vanNuit1.checked || vanNuit2.checked || vanNuit3.checked)
  ) {
    // Si c'est le cas, désélectionnez automatiquement les options précédentes
    vanNuit1.checked = false;
    vanNuit2.checked = false;
    vanNuit3.checked = false;
  }
}

//  new js

let nombrePlaces = document.getElementById("nombrePlaces");
//pour recuperer la valeur du input type number
let nombrePlacesValue = 0;
nombrePlaces.addEventListener("change", function () {
  nombrePlacesValue = parseInt(nombrePlaces.value);
});

nombrePlaces.addEventListener("input", function () {
  // Remove any non-integer characters from the input
  this.value = this.value.replace(/[^\d]/g, "");

  var inputValue = parseInt(this.value);
  if (isNaN(inputValue) || inputValue > 20 || inputValue <= 0) {
    this.value = ""; // Clear the input field
    alertMessage.textContent = "Choisissez un nombre entier entre 1 et 20";
  } else {
    alertMessage.textContent = "";
  }
});

let nombreCasquesEnfants = document.getElementById("nombreCasquesEnfants");
nombreCasquesEnfants.addEventListener("input", function () {
  // Remove any non-integer characters from the input
  this.value = this.value.replace(/[^\d]/g, "");

  var inputValue = parseInt(this.value);
  if (isNaN(inputValue) || inputValue > 5 || inputValue < 0) {
    this.value = ""; // Clear the input field
    alertMessageEnfants.textContent =
      "Choisissez un nombre entier entre 1 et 5";
  } else {
    alertMessageEnfants.textContent = "";
  }
});
let NombreLugesEte = document.getElementById("NombreLugesEte");
NombreLugesEte.addEventListener("input", function () {
  // Remove any non-integer characters from the input
  this.value = this.value.replace(/[^\d]/g, "");

  var inputValue = parseInt(this.value);
  if (isNaN(inputValue) || inputValue > 5 || inputValue < 0) {
    this.value = ""; // Clear the input field
    alertMessageEte.textContent = "Choisissez un nombre entier entre 1 et 5";
  } else {
    alertMessageEte.textContent = "";
  }
});

function afficherMasquerCasques() {
  let radioEnfantsOui = document.getElementById("enfantsOui");
  let sectionCasquesEnfants = document.getElementById("casquesEnfants");

  if (radioEnfantsOui.checked) {
    sectionCasquesEnfants.style.display = "block";
  } else {
    sectionCasquesEnfants.style.display = "none";
  }
}

// pour afficher at cacher la section venir avec des enfants.

let venirAvecDesEnfants = document.getElementById("venirAvecDesEnfants");
let casquesEnfants = document.getElementById("casquesEnfants");
venirAvecDesEnfants.addEventListener("change", function () {
  if (venirAvecDesEnfants.value === "Non") {
    nombreCasquesEnfants.value = "";
    casquesEnfants.style.display = "none";

    // alertOptionEnfant.style.display = "none";
  } else if (venirAvecDesEnfants.value === "Oui") {
    casquesEnfants.style.display = "block";
  }
});

function enableCheckboxChoixJour() {
  let pass1jour = document.getElementById("pass1jour");
  let choixJour1 = document.getElementById("choixJour1");
  let choixJour2 = document.getElementById("choixJour2");
  let choixJour3 = document.getElementById("choixJour3");
  if (!pass1jour.checked) {
    choixJour1.checked = false;
    choixJour2.checked = false;
    choixJour3.checked = false;
  }
  let pass1jourreduit = document.getElementById("pass1jourreduit");
  if (!pass1jourreduit.checked) {
    choixJour1reduit.checked = false;
    choixJour2reduit.checked = false;
    choixJour3reduit.checked = false;
  }
}

setInterval(enableCheckboxChoixJour, 10);

function enableCheckboxChoixJours2() {
  let pass2jours = document.getElementById("pass2jours");
  let choixJour12 = document.getElementById("choixJour12");
  let choixJour23 = document.getElementById("choixJour23");
  if (!pass2jours.checked) {
    choixJour12.checked = false;
    choixJour23.checked = false;
  }
  let pass2joursreduit = document.getElementById("pass2joursreduit");
  if (!pass2joursreduit.checked) {
    choixJour12reduit.checked = false;
    choixJour23reduit.checked = false;
  }
}
setInterval(enableCheckboxChoixJours2, 10);

// la calculation total du prix

function calculateTotalPrice() {
  var numberOfReservations = parseInt(
    document.getElementById("nombrePlaces").value
  );

  // Chosen Passes
  var pass1jourPrice = 40;
  var pass2joursPrice = 70;
  var pass3joursPrice = 100;
  var totalPassPrice = 0;

  var tarifReduitChecked = document.getElementById("tarifReduit").checked;
  var tarifReduitPass1jourPrice = 25;
  var tarifReduitPass2joursPrice = 50;
  var tarifReduitPass3joursPrice = 65;

  if (tarifReduitChecked) {
    if (document.getElementById("pass1jourreduit").checked)
      totalPassPrice += tarifReduitPass1jourPrice;
    if (document.getElementById("pass2joursreduit").checked)
      totalPassPrice += tarifReduitPass2joursPrice;
    if (document.getElementById("pass3joursreduit").checked)
      totalPassPrice += tarifReduitPass3joursPrice;
  } else {
    if (document.getElementById("pass1jour").checked)
      totalPassPrice += pass1jourPrice;
    if (document.getElementById("pass2jours").checked)
      totalPassPrice += pass2joursPrice;
    if (document.getElementById("pass3jours").checked)
      totalPassPrice += pass3joursPrice;
  }

  // Optional Extras
  var tentPrice = 5;
  var vanPrice = 5;
  var tent3NuitsPrice = 12;
  var van3NuitsPrice = 12;
  var enfantsCasquePrice = 2;
  var lugePrice = 5;
  var totalExtrasPrice = 0;

  // Check if all tenteNuit options are selected
  var allTenteNuitsChecked =
    document.getElementById("tenteNuit1").checked &&
    document.getElementById("tenteNuit2").checked &&
    document.getElementById("tenteNuit3").checked;
  if (allTenteNuitsChecked) {
    totalExtrasPrice += tent3NuitsPrice;
  } else {
    // Check if any tenteNuit option is selected and calculate the total tent price accordingly
    if (document.getElementById("tenteNuit1").checked)
      totalExtrasPrice += tentPrice;
    if (document.getElementById("tenteNuit2").checked)
      totalExtrasPrice += tentPrice;
    if (document.getElementById("tenteNuit3").checked)
      totalExtrasPrice += tentPrice;
  }

  // Check if all vanNuit options are selected
  var allVanNuitsChecked =
    document.getElementById("vanNuit1").checked &&
    document.getElementById("vanNuit2").checked &&
    document.getElementById("vanNuit3").checked;
  if (allVanNuitsChecked) {
    totalExtrasPrice += van3NuitsPrice;
  } else {
    // Check if any vanNuit option is selected and calculate the total van price accordingly
    if (document.getElementById("vanNuit1").checked)
      totalExtrasPrice += vanPrice;
    if (document.getElementById("vanNuit2").checked)
      totalExtrasPrice += vanPrice;
    if (document.getElementById("vanNuit3").checked)
      totalExtrasPrice += vanPrice;
  }

  if (document.getElementById("tente3Nuits").checked)
    totalExtrasPrice += tent3NuitsPrice;
  if (document.getElementById("van3Nuits").checked)
    totalExtrasPrice += van3NuitsPrice;
  if (document.getElementById("nombreCasquesEnfants").value !== "")
    totalExtrasPrice +=
      parseInt(document.getElementById("nombreCasquesEnfants").value) *
      enfantsCasquePrice;
  if (document.getElementById("NombreLugesEte").value !== "")
    totalExtrasPrice +=
      parseInt(document.getElementById("NombreLugesEte").value) * lugePrice;

  // Total Calculation
  var totalPrice = (totalPassPrice + totalExtrasPrice) * numberOfReservations;

  // Display the result in a div
  var resultDiv = document.getElementById("totalPriceResult");
  resultDiv.innerHTML = "Total Price: " + totalPrice + "€";
}
