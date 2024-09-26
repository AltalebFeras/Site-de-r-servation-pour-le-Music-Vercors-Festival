<?php

namespace src\Controllers;

use src\Models\Database;
use src\Services\Reponse;
use src\Repositories\Reservation_passRepositories;

class Reservation_passController
{
    use Reponse;

    private $DB;
    private $Reservation_passRepositories;
    private $ReservationRepositories;
    private $PassRepositories;

    public function __construct()
    {
        $database = new Database;
        $this->DB = $database->getDB();
        $this->Reservation_passRepositories = new Reservation_passRepositories;
        require_once __DIR__ . '/../../config.php';
    }

    public function stockerLeJour()
    {
      
        $this->Reservation_passRepositories = new Reservation_passRepositories;
        $reservation_passRepositories = new Reservation_passRepositories();
        $reservation_passRepositories->traitementJour();

        $this->render("dashboard", ["erreur" => ""]);
    }
}
