<?php

namespace src\Repositories;

use src\Models\Utilisateur;
use PDO;
use src\Models\Database;

class UtilisateurRepositories
{
  private $DB;

  public function __construct()
  {
    $database = new Database;
    $this->DB = $database->getDB();

    require_once __DIR__ . '/../../config.php';
  }

  public function getThisUtilisateurById($id): Utilisateur
  {
    $sql = $this->concatenationRequete("WHERE " . PREFIXE . "utilisateur.ID = :id");

    $statement = $this->DB->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
    return $statement->fetch();
  }

  public function createUtilisateur(Utilisateur $Utilisateur): Utilisateur
  {
    $sql = "INSERT INTO " . PREFIXE . "utilisateur (nom, prenom, email, motDePasse, telephone, adresse, RGPD, role ) VALUES (:nom, :prenom,:email,:motDePasse, :telephone, :adresse, :RGPD, :role);";
    $statement = $this->DB->prepare($sql);

    $statement->execute([
      ':nom'=> $Utilisateur->getNom(),
      ':prenom'=> $Utilisateur->getPrenom(),
      ':email'=> $Utilisateur->getEmail(),
      ':motDePasse'=> $Utilisateur->getMotDePasse(),
      ':telephone'=> $Utilisateur->getTelephone(),
      ':adresse'=> $Utilisateur->getAdresse(),
      ':RGPD'=> $Utilisateur->getRgpd()->format("Y-m-d"),
      ':role'=> $Utilisateur->getRole()
    ]);

    $utilisateurID = $this->DB->lastInsertId();
    $Utilisateur->setUtilisateurID($utilisateurID);

    return $Utilisateur;
  }
  


  public function findByEmail($email)
  {
     
          $request = 'SELECT * FROM ' . PREFIXE . 'utilisateur WHERE email = :email';
          $query = $this->DB->prepare($request);

          $query->execute(['email' => $email]);

          $utilisateur = $query->fetch(PDO::FETCH_ASSOC);

          return $utilisateur ? $utilisateur : false;
     
  }
  public function deleteThisUtilisateur($Id): bool
  {
    

  //   a creer delete user;
  }
}
