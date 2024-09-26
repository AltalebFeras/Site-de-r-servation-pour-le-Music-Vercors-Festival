<?php

namespace src\Controllers;

use src\Models\Database;
use src\Services\Reponse;
use src\Repositories\NuiteeRepositories;
use src\Repositories\ReservationRepositories;

class NuiteeController
{
    use Reponse;

    private $DB;
    private $NuiteeRepositories;

    public function __construct()
    {
        $database = new Database;
        $this->DB = $database->getDB();
        $this->NuiteeRepositories = new NuiteeRepositories;
        require_once __DIR__ . '/../../config.php';
    }

    public function stockerLaNuitee()
    {
        $NuiteeRepositories = new NuiteeRepositories();
        $this->NuiteeRepositories->traitementNuitee($NuiteeRepositories);
        $this->render("dashboard", ["erreur" => ""]);
    }
}
