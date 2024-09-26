<?php
include_once __DIR__ . '/Includes/header.php';



if (isset($_SESSION['error_message0'])) {
  echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message0'] . '</div>';
  unset($_SESSION['error_message0']);
}
?>
<form action="" id="inscriptionForm" method="post" >

  <fieldset class=" d-flex flex-column "  >

    <legend>Inscription</legend>
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required autocomplete="family-name">
    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" required autocomplete="given-name">
    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required autocomplete="email">

    <label for="motDePasse">Mot de passe :</label>
    <input type="password" name="motDePasse" id="motDePasse" min="8" required>
    <label for="motDePasseVerifier">Verifier le mot de passe :</label>
    <input type="password" name="motDePasseVerifier" min="8" id="motDePasseVerifier">
    <span class="password-toggle fw-bold mb-3" id="togglePassword">Voir le MDP</span>


    <label for="telephone">Téléphone :</label>
    <input type="text" name="telephone" id="telephone" required autocomplete="tel">
    <label for="adresse">Adresse Postale :</label>
    <input type="text" name="adresse" id="adresse" required autocomplete="address-line1">
    <div class="d-flex flex-row align-items-baseline my-2">
      <input type="checkbox" class="me-2" name="RGPD" id="RGPD" enababled>
      <label for="RGPD">Veuillez accepter les RGPD </label>
    </div>
    <div id="alertMessageRGPD" class="bg-danger text-white mb-3"></div>
    <div class="d-flex justify-content-between">
      <!-- <p class="btn btn-warning" id="btnPrecedent2">Précédent</p> -->
      <input type="submit" name="soumission" class="btn btn-success" disabled id="btnInscrire" value="S'inscrire" onclick="calculateTotalPrice()">
    </div>
  </fieldset>
</form>

<?php
include_once __DIR__ . '/Includes/footer.php';

?>