
document
  .getElementById("togglePassword")
  .addEventListener("click", function () {
    var motDePasseInput = document.getElementById("motDePasse");
    var motDePasseVerifierInput = document.getElementById("motDePasseVerifier");
    var togglePasswordSpan = document.getElementById("togglePassword");

    if (motDePasseInput.type === "password") {
      motDePasseInput.type = "text";
      motDePasseVerifierInput.type = "text";
      togglePasswordSpan.textContent = "Cacher le MDP";
    } else {
      motDePasseInput.type = "password";
      motDePasseVerifierInput.type = "password";
      togglePasswordSpan.textContent = "Voir le MDP";
    }
  });

document
  .getElementById("telephone")
  .addEventListener("input", function (event) {
    let input = event.target.value;
    let formattedPhoneNumber = input.replace(/[^\d+]/g, ""); // Supprime tous les caractères non numériques
    event.target.value = formattedPhoneNumber;
  });
 

let rgpdCheckbox = document.getElementById("RGPD");
let btnInscrire = document.getElementById("btnInscrire");
rgpdCheckbox.addEventListener("change", function () {
  if (rgpdCheckbox.checked) {
    btnInscrire.disabled = false;
    alertMessageRGPD.textContent = "";
  } else {
    btnInscrire.disabled = true;
    alertMessageRGPD.textContent = "Please agree to the RGPD terms.";
  }
});

let form = document.getElementById("inscriptionForm");
let alertMessageRGPD = document.getElementById("alertMessageRGPD");

form.addEventListener("submit", function (event) {
  event.preventDefault();

  if (rgpdCheckbox.checked) {
    form.submit();
  } else {
    alertMessageRGPD.textContent = "Please agree to the RGPD terms.";
    rgpdCheckbox.focus();
  }
});

// la calculation total du prix

 