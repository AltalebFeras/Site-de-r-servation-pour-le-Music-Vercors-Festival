<?php

namespace src\Repositories;

use PDO;
use PDOException;
use src\Models\Reservation;
use src\Models\Database;

class ReservationRepositories
{
  private $DB;

  public function __construct()
  {
    $database = new Database;
    $this->DB = $database->getDB();

    require_once __DIR__ . '/../../config.php';
  }



  public function   traitementReservation(ReservationRepositories $ReservationRepositories)
  {
    if (empty($_POST) || !isset($_POST['nombreReservations'])) {
      $nombreReservations = htmlspecialchars($_POST['nombreReservations']);
    }
    $totalPrice = $this->calculation();
    $nombreReservations = $_POST['nombreReservations'];
    $utilisateurID = $_SESSION['utilisateur'];
    $data = array(
      'nombreReservations' => $nombreReservations,
      'prixTotal' => $totalPrice,
      'utilisateurID' => $utilisateurID
    );

    $reservation = new Reservation($data);
    $ReservationRepositories->createReservation($reservation);
    $_SESSION['reserved'] =true;
    $_SESSION['message'] = "Votre réservation est validée!";
    

  }




  public function createReservation(Reservation $Reservation): Reservation
  {
    $sql = "INSERT INTO " . PREFIXE . "reservation (nombreReservations, prixTotal, utilisateurID )
     VALUES (:nombreReservations, :prixTotal, :utilisateurID );";
    $statement = $this->DB->prepare($sql);
    $retour = $statement->execute([
      ':nombreReservations' => $Reservation->getNombreReservations(),
      ':prixTotal' => $Reservation->getPrixTotal(),
      ':utilisateurID' => $Reservation->getUtilisateurID()
    ]);



    $reservationID = $this->DB->lastInsertId();
    $Reservation->setReservationID($reservationID);
    $_SESSION['reservationID'] =$this->DB->lastInsertId();
    return $Reservation;
  }
  public function insertID(Reservation $Reservation): Reservation
  {
    $sql = "INSERT INTO " . PREFIXE . "reservation (utilisateurID) VALUES (:utilisateurID)";
    $statement = $this->DB->prepare($sql);
    $statement->execute([
      ':utilisateurID' => $_SESSION['utilisateur']
    ]);
    $Reservation->setUtilisateurID($this->DB->lastInsertId());

    return $Reservation;
  }
  


  public function UpdateReservation(Reservation $Reservation): bool
  {
    $sql = "UPDATE " . PREFIXE . "mvf_reservation 
            SET
              nombreReservations = :nombreReservations,
              prixTotal = :prixTotal
            WHERE reservationID = :reservationID";

    $statement = $this->DB->prepare($sql);

    $retour = $statement->execute([
      ':reservationID' => $Reservation->getReservationId(),
      ':nombreReservations' => $Reservation->getnombreReservations(),
      ':prixTotal' => $Reservation->getPrixTotal()
    ]);

    return $retour;
  }

  public function deleteReservation(int $ID): bool
  {
    try {
      $sql = "DELETE FROM " . PREFIXE . "mvf_reservation WHERE reservationID = :reservationID;";

      $statement = $this->DB->prepare($sql);

      return $statement->execute([':reservationID' => $ID]);
    } catch (PDOException $error) {
      echo "Erreur de suppression : " . $error->getMessage();
      return false;
    }
  }


  public function getAllReservation()
  {
    $sql = "SELECT * FROM " . PREFIXE . "mvf_reservation;";

    $retour = $this->DB->query($sql)->fetchAll(PDO::FETCH_CLASS, Reservation::class);

    return $retour;
  }

  public function displayUserReservations()
  {
      if (!isset($_SESSION['utilisateur'])) {
          echo "User not logged in.";
          return;
      }
      
      $userID = $_SESSION['utilisateur'];
  
      $sql = "SELECT * FROM " . PREFIXE . "reservation WHERE utilisateurID = :userID";
      $stmt = $this->DB->prepare($sql);
      $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $stmt->execute();
      $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
      if ($reservations) {
       
          echo "<table>
              <tr>
                  <th>Reservation Référence</th>
                  <th>Nombre de Reservations</th>
                  <th>Prix Total</th>
                  <th>Nuitée</th>
                  <th>Pass Journée</th>
                  <th>Options Supplémentaire</th>
                 
              </tr>";
  
          foreach ($reservations as $reservation) {
              $userID = $reservation['utilisateurID'];
              $userReservations = $this->getUserReservations($userID);
              $userOptions = $this->getUserOptions($userID);
  
              $reservationID = $reservation['reservationID'];
              $userReservationNuitee = $this->getUserReservationNuitee($reservationID);
              $userReservationPass = $this->getUserReservationPass($reservationID);
  
              echo "<tr>
                  <td>{$reservation['reservationID']}</td>
                  <td>{$reservation['nombreReservations']}</td>
                  <td>{$reservation['prixTotal']} €</td>
                  <td>$userReservationNuitee</td>
                  <td>$userReservationPass</td>
                  <td>$userOptions</td>
              </tr>";
          }
  
          echo "</table>";
      } else {
        ?>
        <div>
          <p class="fs-1">Vous n'avez pas de réservation!</p>
            <p class=" fs-3" > Cliquez sur le
                <a href="/">👉ICI👈</a>
                pour créer une réservation.
            </p>
        </div>
        <?php
    }
    
  }
  

public function displayAllReservations()
{
    $sql = "SELECT * FROM " . PREFIXE . "reservation;";
    $stmt = $this->DB->prepare($sql);
    $stmt->execute();
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($reservations) {
        echo "<table border='1'>
            <tr>
            <th>Reservation Référence</th>
            <th>Nombre de Reservations</th>
            <th>Prix Total</th>
            <th>Nuitée</th>
            <th>Pass Journée</th>
            <th>Options Supplémentaire</th>
            </tr>";

        foreach ($reservations as $reservation) {
            $userID = $reservation['utilisateurID'];
            $userReservations = $this->getUserReservations($userID);
            $userOptions = $this->getUserOptions($userID);

        
            $userNights = $this->getUserNights($userID);

            $reservationID = $reservation['reservationID'];
            $userReservationNuitee = $this->getUserReservationNuitee($reservationID);
            $userReservationPass = $this->getUserReservationPass($reservationID);

            echo "<tr>
            <td>{$reservation['reservationID']}</td>
            <td>{$reservation['nombreReservations']}</td>
            <td>{$reservation['prixTotal']}</td>
            <td>$userReservationNuitee</td>
            <td>$userReservationPass</td>
            <td>$userOptions</td>

            </tr>";
        }

        echo "</table>";
    } else {
        echo "No reservations found.";
    }
}

public function getUserReservationNuitee($reservationID)
{
    $nights = "";
    $sql = "SELECT nomNuitee FROM " . PREFIXE . "nuitee WHERE nuiteeID IN (SELECT nuiteeID FROM " . PREFIXE . "reservation_nuitee WHERE reservationID = :reservationID);";
    $stmt = $this->DB->prepare($sql);
    $stmt->bindParam(':reservationID', $reservationID, PDO::PARAM_INT);
    $stmt->execute();
    $nightsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($nightsData) {
        foreach ($nightsData as $night) {
            $nights .= $night['nomNuitee'] . "<br>";
        }
    }

    return $nights;
}

public function getUserReservationPass($reservationID)
{
    $passes = "";
    $sql = "SELECT nomPass FROM " . PREFIXE . "pass WHERE passID IN (SELECT passID FROM " . PREFIXE . "reservation_pass WHERE reservationID = :reservationID);";
    $stmt = $this->DB->prepare($sql);
    $stmt->bindParam(':reservationID', $reservationID, PDO::PARAM_INT);
    $stmt->execute();
    $passesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($passesData) {
        foreach ($passesData as $pass) {
            $passes .= $pass['nomPass'] . "<br>";
        }
    }

    return $passes;
}


public function getUserOptions($reservationID)
{
    $options = "";
    $sql = "SELECT mvf_options.nomOption FROM mvf_options INNER JOIN mvf_reservation_option ON mvf_options.optionID = mvf_reservation_option.optionID WHERE mvf_reservation_option.reservationID = :reservationID;";
    $stmt = $this->DB->prepare($sql);
    $stmt->bindParam(':reservationID', $reservationID, PDO::PARAM_INT);
    $stmt->execute();
    $optionsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($optionsData) {
        foreach ($optionsData as $option) {
            $options .= $option['nomOption'] . "<br>";
        }
    }

    return $options;
}



public function getUserNights($userID)
{
    $nights = "";
    $sql = "SELECT nomNuitee FROM " . PREFIXE . "nuitee WHERE nuiteeID IN (SELECT nuiteeID FROM " . PREFIXE . "reservation_nuitee WHERE reservationID IN (SELECT reservationID FROM " . PREFIXE . "reservation WHERE utilisateurID = :userID));";
    $stmt = $this->DB->prepare($sql);
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->execute();
    $nightsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($nightsData) {
        foreach ($nightsData as $night) {
            $nights .= $night['nomNuitee'] . "<br>";
        }
    }

    return $nights;
}

private function getUserReservations($userID)
{
    $sql = "SELECT prixTotal, nombreReservations FROM mvf_reservation WHERE utilisateurID = :userID";
    $stmt = $this->DB->prepare($sql);
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->execute();
    $userReservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = "<ul>";
    foreach ($userReservations as $reservation) {
        $html .= "<li>Number of Reservations: {$reservation['nombreReservations']}</li>";
        $html .= "<li>Total Price: {$reservation['prixTotal']}</li>";
    }
    $html .= "</ul>";

    return $html;
}
 
   
  public function calculation()
  {
    $numberOfReservations = intval($_POST["nombreReservations"]);

    $pass1jourPrice = 40;
    $pass2joursPrice = 70;
    $pass3joursPrice = 100;
    $totalPassPrice = 0;

    $tarifReduitChecked = isset($_POST["tarifReduit"]);
    $tarifReduitPass1jourPrice = 25;
    $tarifReduitPass2joursPrice = 50;
    $tarifReduitPass3joursPrice = 65;

    if ($tarifReduitChecked) {
      if ($_POST["choixPassReduit"] == "pass1jourreduit")
        $totalPassPrice += $tarifReduitPass1jourPrice;
      if ($_POST["choixPassReduit"] == "pass2joursreduit")
        $totalPassPrice += $tarifReduitPass2joursPrice;
      if ($_POST["choixPassReduit"] == "pass3joursreduit")
        $totalPassPrice += $tarifReduitPass3joursPrice;
    } else {

      if ($_POST["choixPass"] == "pass1jour")
        $totalPassPrice += $pass1jourPrice;
      if ($_POST["choixPass"] == "pass2jours")
        $totalPassPrice += $pass2joursPrice;
      if ($_POST["choixPass"] == "pass3jours")
        $totalPassPrice += $pass3joursPrice;
    }

    $tentPrice = 5;
    $vanPrice = 5;
    $tent3NuitsPrice = 12;
    $van3NuitsPrice = 12;
    $enfantsCasquePrice = 2;
    $lugePrice = 5;
    $totalExtrasPrice = 0;

     if (isset($_POST["tenteNuit1"]) || isset($_POST["tenteNuit2"]) || isset($_POST["tenteNuit3"])) {
      $numberOfTenteNuits = 0;
      if (isset($_POST["tenteNuit1"])) $numberOfTenteNuits++;
      if (isset($_POST["tenteNuit2"])) $numberOfTenteNuits++;
      if (isset($_POST["tenteNuit3"])) $numberOfTenteNuits++;
      $totalExtrasPrice += $tentPrice * $numberOfTenteNuits;
    }

    if (isset($_POST["vanNuit1"]) || isset($_POST["vanNuit2"]) || isset($_POST["vanNuit3"])) {
      $numberOfVanNuits = 0;
      if (isset($_POST["vanNuit1"])) $numberOfVanNuits++;
      if (isset($_POST["vanNuit2"])) $numberOfVanNuits++;
      if (isset($_POST["vanNuit3"])) $numberOfVanNuits++;
      $totalExtrasPrice += $vanPrice * $numberOfVanNuits;
    }
    if (isset($_POST["tente3Nuits"]))
      $totalExtrasPrice += $tent3NuitsPrice;
    if (isset($_POST["van3Nuits"]))
      $totalExtrasPrice += $van3NuitsPrice;
    if (isset($_POST["nombreCasquesEnfants"]))
      $totalExtrasPrice += intval($_POST["nombreCasquesEnfants"]) * $enfantsCasquePrice;
    if (isset($_POST["NombreLugesEte"]))
      $totalExtrasPrice += intval($_POST["NombreLugesEte"]) * $lugePrice;


    // Total Calculation
    $totalPrice = ($totalPassPrice + $totalExtrasPrice) * $numberOfReservations;

    return $totalPrice;
  }
}
