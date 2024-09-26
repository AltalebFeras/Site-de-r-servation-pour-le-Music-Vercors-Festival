<?php

namespace src\Controllers;

use src\Models\Database;
use src\Services\Reponse;
use src\Repositories\OptionsRepositories;
use src\Repositories\ReservationRepositories;

class OptionsController
{
    use Reponse;

    private $DB;
    private $OptionsRepositories;

    public function __construct()
    {
        $database = new Database;
        $this->DB = $database->getDB();
        $this->OptionsRepositories = new OptionsRepositories;
        require_once __DIR__ . '/../../config.php';
    }

    public function stockerLesOptions()
    {
        $OptionsRepositories = new OptionsRepositories();
        $this->OptionsRepositories->traitementOptions($OptionsRepositories);
        $this->render("dashboard", ["erreur" => ""]);
    }
}
