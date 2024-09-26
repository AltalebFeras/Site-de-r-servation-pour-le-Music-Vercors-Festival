<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;
use src\Models\Pass;
use src\Models\Reservation;

class Reservation_passRepositories
{
    private $DB;
   

    public function __construct()
    {
        $database = new Database;
        $this->DB = $database->getDB();
      

        require_once __DIR__ . '/../../config.php';
    }

   
   
    public function getJour($choixJour)
    {
        
        switch ($choixJour) {
            case 'choixJour1':
                return '01/07/2024';

            case 'choixJour2':
                return '02/07/2024';

            case 'choixJour3':
                return '03/07/2024';

            case 'choixJour1reduit':
                return '01/07/2024';

            case 'choixJour2reduit':
                return '02/07/2024';

            case 'choixJour3reduit':
                return '03/07/2024';

            case 'choixjour12':
                return '01/07/2024' . '/' . '02/07/2024';

            case 'choixjour23':
                return '02/07/2024' . '/' . '03/07/2024';

            case 'choixJour12reduit':
                return '01/07/2024' . '/' . '02/07/2024';

            case 'choixJour23reduit':
                return '02/07/2024' . '/' . '03/07/2024';

            case 'pass3jours':
                return '01/07/2024' . '/' . '02/07/2024' . '/' . '03/07/2024';

            case 'pass3joursreduit':
                return '01/07/2024' . '/' . '02/07/2024' . '/' . '03/07/2024';

            default:
                return ''; // Default price if pass type not recognized
        }
    }





public function traitementJour()
{
    $jour = '';

    if (isset($_POST['choixJour'])) {
        $choixJour = $_POST['choixJour'];
        if ($this->isValidJour($choixJour)) {
            $jour = $this->getJour($choixJour);
        }
    } elseif (isset($_POST['choixJour2'])) {
        $choixJour = $_POST['choixJour2'];
        if ($this->isValidJour2($choixJour)) {
            $jour = $this->getJour($choixJour);
        }
    } elseif (isset($_POST['choixPass'])) {
        $choixJour = $_POST['choixPass'];
        if ($choixJour === "pass3jours") {
            $jour = $this->getJour($choixJour);
        }
    } elseif (isset($_POST['choixJourReduit'])) {
        $choixJour = $_POST['choixJourReduit'];
        if ($this->isValidJourReduit($choixJour)) {
            $jour = $this->getJour($choixJour);
        }
    } elseif (isset($_POST['choixJour2Reduit'])) {
        $choixJour = $_POST['choixJour2Reduit'];
        if ($this->isValidJour2Reduit($choixJour)) {
            $jour = $this->getJour($choixJour);
        }
    } elseif (isset($_POST['choixPassReduit'])) {
        $choixJour = $_POST['choixPassReduit'];
        if ($choixJour === "pass3joursreduit") {
            $jour = $this->getJour($choixJour);
        }
    }

    if (!empty($jour)) {
        $passID = $_SESSION['passID'];
        $reservationID = $_SESSION['reservationID'];
        $sql = "INSERT INTO " . PREFIXE . "reservation_pass (jour, passID, reservationID)
                VALUES (:jour, :passID, :reservationID)";
        $statement = $this->DB->prepare($sql);
        $retour = $statement->execute([
            ':jour' => $jour,
            ':passID' => $passID,
            ':reservationID' => $reservationID,
        ]);
    }
}

private function isValidJour($choixJour)
{
    return in_array($choixJour, ["choixJour1", "choixJour2", "choixJour3"]);
}

private function isValidJour2($choixJour)
{
    return in_array($choixJour, ["choixJour12", "choixJour23"]);
}

private function isValidJourReduit($choixJour)
{
    return in_array($choixJour, ["choixJour1reduit", "choixJour2reduit", "choixJour3reduit"]);
}

private function isValidJour2Reduit($choixJour)
{
    return in_array($choixJour, ["choixJour12reduit", "choixJour23reduit"]);
}

}
