<?php

namespace src\Repositories;
use PDO;
use src\Models\Database;
use src\Models\Pass;

class PassRepositories
{
  private $DB;

  public function __construct()
  {
    $database = new Database;
    $this->DB = $database->getDB();

    require_once __DIR__ . '/../../config.php';
  }

  public function traitementPass(PassRepositories $PassRepositories)
  {
      $prixPass = 0;
      $nomPass = "";
  
      if (isset($_POST['choixPass'])) {
          $prixPass = $this->getPrixPass($_POST['choixPass']);
          $nomPass = htmlspecialchars($_POST['choixPass']);
      } elseif (isset($_POST['choixPassReduit'])) {
          $prixPass = $this->getPrixPass($_POST['choixPassReduit']);
          $nomPass = htmlspecialchars($_POST['choixPassReduit']);
      } else {
         echo "error choisi un pass";
      }
  
      
      $pass = new Pass(['prixPass' => $prixPass, 'nomPass' => $nomPass]);
      
      $PassRepositories->createPass($pass);
  }
  
  public function createPass(Pass $Pass): Pass
  {
      $sql = "INSERT INTO " . PREFIXE . "pass (prixPass, nomPass )
              VALUES (:prixPass, :nomPass )";
      $statement = $this->DB->prepare($sql);
      $retour = $statement->execute([
          ':prixPass' => $Pass->getPrixPass(),
          ':nomPass' => $Pass->getNomPass(),
      ]);
    

      $passID = $this->DB->lastInsertId();
      $Pass->setPassID($passID);
      $_SESSION['passID'] =$this->DB->lastInsertId();
  

      return $Pass;
  }
  
  private function getPrixPass($choixPass)
  {
      switch ($choixPass) {
          case 'pass1jour':
              return 40;
          case 'pass2jours':
              return 70;
          case 'pass3jours':
              return 100;
          case 'pass1jourreduit':
              return 25;
          case 'pass2joursreduit':
              return 50;
          case 'pass3joursreduit':
              return 65;
          default:
              return 0; // Default price if pass type not recognized
      }
  }  
}
