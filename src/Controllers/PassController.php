<?php

namespace src\Controllers;

use src\Models\Database;
use src\Services\Reponse;
use src\Repositories\PassRepositories;
use src\Repositories\ReservationRepositories;

class PassController
{
    use Reponse;

    private $DB;
    private $PassRepositories;

    public function __construct()
    {
        $database = new Database;
        $this->DB = $database->getDB();
        $this->PassRepositories = new PassRepositories;
        require_once __DIR__ . '/../../config.php';
    }

    public function stockerLePass()
    {
        $PassRepositories = new PassRepositories();
        $this->PassRepositories->traitementPass($PassRepositories);
        $this->render("dashboard", ["erreur" => ""]);
    }
}
