<?php

namespace src\Controllers;

use src\Services\Reponse;

class HomeController
{

  use Reponse;

  public function index(): void
  {
    if (isset($_GET['erreur'])) {
      $erreur = htmlspecialchars($_GET['erreur']);
    } else {
      $erreur = '';
    }

    $this->render("accueil", ["erreur" => $erreur]);
  }
  public function connexion(): void
  {
    if (isset($_GET['erreur'])) {
      $erreur = htmlspecialchars($_GET['erreur']);
    } else {
      $erreur = '';
    }

    $this->render("connexion", ["erreur" => $erreur]);
  }

  public function indexAdmin(): void
  {
    $erreur = isset($_GET['erreur']) ? htmlspecialchars($_GET['erreur']) : 'error';

    $_SESSION['role']= 'admin';

    $this->render("admin", ["erreur" => $erreur]);
  }
  public function indexConnexion(): void
{
    $erreur = isset($_GET['erreur']) ? htmlspecialchars($_GET['erreur']) : '';
    
    $_SESSION['role']= 'user';


    $this->render("connexion", ["erreur" => $erreur]);
}

  public function authAdmin(string $motDePasseAdmin): void
  {
      
      if ($motDePasseAdmin === 'admin' && $_SESSION['role']= 'admin') {
      $_SESSION['connecté'] = true;
      header('location: ' . HOME_URL . 'dashboard');
      die();
    } else {
      header('location: ' . HOME_URL .'admin'. '?erreur=connexion');
    }
  }


  // will change the password for user to motDePasse
  public function authUser(string $motDePasseAdmin): void
  {
    if ($motDePasseAdmin === 'admin') {
      $_SESSION['connecté'] = TRUE;
      header('location: ' . HOME_URL . 'dashboard');
      die();
    } else {
      header('location: ' . HOME_URL .'admin'.'?erreur=connexion');
    }
  }

  public function quit()
  {
    session_destroy();
    header('location: ' . HOME_URL);
    die();
  }

  public function page404(): void
  {
    header("HTTP/1.1 404 Not Found");
    $this->render('404');
  }
}
