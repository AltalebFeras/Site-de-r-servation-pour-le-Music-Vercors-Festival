<?php
include_once __DIR__ . '/Includes/header.php';
include_once __DIR__ . '/Includes/colonne.php';
if (isset($_SESSION['connecté'])) {
  echo '<div><a href="/" class="btn btn-info">dashoard</a>';
}
if ($_SESSION['role'] == 'user') {

?>
 
  <form action="" id="inscription" method="post" oninput="calculateTotalPrice()">

    <div class="d-flex">
      <input type="checkbox" class="d-none" id="Actualiserleprix" />
      <label class="mx-2" for="Actualiserleprix">↻</label>
      <div id="totalPriceResult"></div>
    </div>


    <fieldset  id="reservation">

      <legend>Réservation</legend>
      <h3>Nombre de réservation(s) :</h3>
      <input type="number" name="nombreReservations" id="nombrePlaces" min="1" max="20" required>
      <div id="alertMessage" class="bg-danger text-white"></div>
      <h3>Réservation(s) en tarif réduit</h3>
      <input type="checkbox" name="tarifReduit" id="tarifReduit" onclick="afficherMasquerTarifsReduits()">
      <label for="tarifReduit">Ma réservation sera en tarif réduit</label>

      <h3>Choisissez votre formule :</h3>
      <div id="tarifsNormaux">
        <input type="radio" name="choixPass" id="pass1jour" value="pass1jour" onclick="choixDate1jour()">
        <label for="pass1jour">Pass 1 jour : 40€</label>

        <!-- Si case cochée, afficher le choix du jour -->
        <section id="pass1jourDate">
          <div>
            <input type="radio" name="choixJour" id="choixJour1" value="choixJour1" />
            <label for="choixJour1">Pass pour la journée du 01/07</label>
          </div>
          <div> <input type="radio" name="choixJour" id="choixJour2" value="choixJour2" />
            <label for="choixJour2">Pass pour la journée du 02/07</label>
          </div>
          <div> <input type="radio" name="choixJour" id="choixJour3" value="choixJour3" />
            <label for="choixJour3">Pass pour la journée du 03/07</label>
          </div>
        </section>

        <input type="radio" name="choixPass" id="pass2jours" value="pass2jours" onclick="choixDate2jours()">
        <label for="pass2jours">Pass 2 jours : 70€</label>

        <!-- Si case cochée, afficher le choix des jours -->
        <section id="pass2joursDate">
          <div>
            <input type="radio" name="choixJour2" id="choixJour12" value="choixjour12" />
            <label for="choixJour12">Pass pour deux journées du 01/07 au 02/07</label>
          </div>
          <div>
            <input type="radio" name="choixJour2" id="choixJour23" value="choixjour23" />
            <label for="choixJour23">Pass pour deux journées du 02/07 au 03/07</label>
          </div>
        </section>

        <input type="radio" name="choixPass" id="pass3jours" value="pass3jours">
        <label for="pass3jours">Pass 3 jours : 100€</label>
      </div>

      <!-- tarifs réduits : à n'afficher que si tarif réduit est sélectionné -->
      <section class="tarifsReduits" id="tarifsReduits">
        <input type="radio" name="choixPassReduit" id="pass1jourreduit" value="pass1jourreduit" onclick="choixDate1jourReduit()">
        <label for="pass1jourreduit">Pass 1 jour : 25€</label>

        <section id="pass1jourDateReduit">
          <div>
            <input type="radio" name="choixJourReduit" id="choixJour1reduit" value="choixJour1reduit" />
            <label for="choixJour1reduit">Pass pour la journée du 01/07</label>
          </div>
          <div>
            <input type="radio" name="choixJourReduit" id="choixJour2reduit" value="choixJour2reduit" />
            <label for="choixJour2reduit">Pass pour la journée du 02/07</label>
          </div>
          <div>
            <input type="radio" name="choixJourReduit" id="choixJour3reduit" value="choixJour3reduit" />
            <label for="choixJour3reduit">Pass pour la journée du 03/07</label>
          </div>
        </section>


        <input type="radio" name="choixPassReduit" id="pass2joursreduit" value="pass2joursreduit" onclick="choixDate2joursReduit()">
        <label for="pass2joursreduit">Pass 2 jours : 50€</label>

        <section id="pass2joursDateReduit">
          <div>
            <input type="radio" name="choixJour2Reduit" id="choixJour12reduit" value="choixJour12reduit" />
            <label for="choixJour12reduit">Pass pour deux journées du 01/07 au 02/07</label>
          </div>
          <div>
            <input type="radio" name="choixJour2Reduit" id="choixJour23reduit" value="choixJour23reduit" />
            <label for="choixJour23reduit">Pass pour deux journées du 02/07 au 03/07</label>
          </div>
        </section>

        <input type="radio" name="choixPassReduit" id="pass3joursreduit" value="pass3joursreduit">
        <label for="pass3joursreduit">Pass 3 jours : 65€</label>
      </section>

      <div>
        <p class="btn btn-info" id="btnSuivant1">Suivant</p>
        <div id="alertOption" class="bg-danger text-white"></div>

      </div>

    </fieldset>
    <fieldset id="options">
      <h3>Réserver un emplacement de tente : </h3>
      <input type="checkbox" id="tenteNuit1" name="tenteNuit1" class="tenteNuit" value="tenteNuit1" onchange="cocherTente3nuits()">
      <label for="tenteNuit1">Pour la nuit du 01/07 (5€)</label><br>
      <input type="checkbox" id="tenteNuit2" name="tenteNuit2" class="tenteNuit" value="tenteNuit2" onchange="cocherTente3nuits()">
      <label for="tenteNuit2">Pour la nuit du 02/07 (5€)</label><br>
      <input type="checkbox" id="tenteNuit3" name="tenteNuit3" class="tenteNuit" value="tenteNuit3" onchange="cocherTente3nuits()">
      <label for="tenteNuit3">Pour la nuit du 03/07 (5€)</label><br>
      <input type="checkbox" id="tente3Nuits" name="tente3Nuits" class="tenteNuit" value="tente3Nuits" onchange="cocherTente3nuits()">
      <label for="tente3Nuits">Pour les 3 nuits (12€)</label>

      <h3>Réserver un emplacement de camion aménagé : </h3>
      <input type="checkbox" id="vanNuit1" name="vanNuit1" class="vanNuit" value="vanNuit1" onchange="cocherVan3nuits()">
      <label for="vanNuit1">Pour la nuit du 01/07 (5€)</label><br>
      <input type="checkbox" id="vanNuit2" name="vanNuit2" class="vanNuit" value="vanNuit2" onchange="cocherVan3nuits()">
      <label for="vanNuit2">Pour la nuit du 02/07 (5€)</label><br>
      <input type="checkbox" id="vanNuit3" name="vanNuit3" class="vanNuit" value="vanNuit3" onchange="cocherVan3nuits()">
      <label for="vanNuit3">Pour la nuit du 03/07 (5€)</label><br>
      <input type="checkbox" id="van3Nuits" name="van3Nuits" class="vanNuit" value="van3Nuits" onchange="cocherVan3nuits()">
      <label for="van3Nuits">Pour les 3 nuits (12€)</label>

      <h3>Venez-vous avec des enfants ?</h3>
      <div id="venirAvecDesEnfants">
        <input type="radio" name="enfants" value="Non" id="enfantsNon" onchange="afficherMasquerCasques()" />
        <label for="enfantsNon">Non</label>
        <input type="radio" name="enfants" value="Oui" id="enfantsOui" onchange="afficherMasquerCasques()" />
        <label for="enfantsOui">Oui</label>
      </div>
      <!-- Si oui, afficher : -->
      <section id="casquesEnfants">
        <h4>Voulez-vous louer un casque antibruit pour enfants* (2€ / casque) ?</h4>
        <label for="nombreCasquesEnfants">Nombre de casques souhaités :</label>
        <input type="number" name="nombreCasquesEnfants" id="nombreCasquesEnfants" min="0" max="5">
        <div id="alertMessageEnfants" class="bg-danger text-white"></div>
        <p>*Dans la limite des stocks disponibles.</p>
      </section>

      <h3>Profitez de descentes en luge d'été à tarifs avantageux (5€ / luge) !</h3>
      <label for="NombreLugesEte">Nombre de descentes en luge d'été :</label>
      <input type="number" name="NombreLugesEte" id="NombreLugesEte" min="0" max="5">
      <div id="alertMessageEte" class="bg-danger text-white"></div>

      <div class="d-flex justify-content-between">
        <p class="btn btn-warning" id="btnPrecedent">Précédent</p>
        <input type="submit" name="soumission" class="btn btn-success" id="btnReserver" value="Réserver" onclick="calculateTotalPrice()">
      </div>
    </fieldset>
  </form>

<?php
}
?>
<?php
include_once __DIR__ . '/Includes/footer.php';
?>