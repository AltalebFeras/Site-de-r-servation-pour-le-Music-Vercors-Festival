<?php

use src\Controllers\HomeController;
use src\Controllers\UtilisateurController;
use src\Controllers\ReservationController;
use src\Controllers\PassController;
use src\Controllers\NuiteeController;
use src\Controllers\OptionsController;
use src\Controllers\Reservation_passController;

use src\Services\Routing;

$HomeController = new HomeController;
$UtilisateurController = new UtilisateurController;
$ReservationController = new ReservationController;
$PassController = new PassController;
$NuiteeController = new NuiteeController;
$OptionsController = new OptionsController;
$Reservation_passController = new Reservation_passController;


$route = $_SERVER['REDIRECT_URL'];
$methode = $_SERVER['REQUEST_METHOD'];
$routeComposee = Routing::routeComposee($route);


switch ($route) {
  case HOME_URL:
    if (isset($_SESSION['connecté'])) {
      header('location: ' . HOME_URL . 'dashboard');
      die;
    }
    if ($methode === 'POST') {
      $UtilisateurController->traitmentUtilisateur();
    } else {
      $HomeController->index();
    }
    break;


  case HOME_URL . 'admin':
    if (isset($_SESSION['connecté'])) {
      header('location: /dashboard');
      die;
    } else {
      if ($methode === 'POST') {
        $HomeController->authAdmin($_POST['motDePasseAdmin']);
      } else {
        $HomeController->indexAdmin();
      }
    }
    break;


  case HOME_URL . 'connexion':
    if (isset($_SESSION['connecté'])) {
      header('location: /dashboard');
      die;
    } else {
      if ($methode === 'POST') {
        $UtilisateurController->connexionUtilisateur();
        die;
      } else {
        $HomeController->indexConnexion();
      }
    }
    break;

    case HOME_URL . "createReservation":
      if ($methode === 'POST') {
        $ReservationController->stockerLaReservation();
        $PassController->stockerLePass();
        $NuiteeController->stockerLaNuitee();
        $OptionsController->stockerLesOptions();
        $Reservation_passController->stockerLeJour();  
        // Redirect after handling POST
        header("Location: " . HOME_URL . "dashboard");
        exit;
      } else {
        $UtilisateurController->createReservation();
      }
      break;
    

  case HOME_URL . 'dashboard':
    $UtilisateurController->showDashboard();


    break;

  case HOME_URL . 'deconnexion':
    $HomeController->quit();
    break;

  case $routeComposee[0] == "dashboard":
    if (isset($_SESSION["connecté"])) {

      switch ($route) {
        case $routeComposee[1] == "compte":
          if ($methode === "POST") {
            $UtilisateurController->supprimerUtilisateur();
            // $utilisateurID = $_SESSION['utilisateur'];
          }
          if (isset($_SESSION["connecté"])) {
            $UtilisateurController->afficherCompte();
          }
          break;
        case $routeComposee[1] == "reservation":
          $UtilisateurController->afficherReservation();
          break;
        
        case $routeComposee[1] == 'deconnexion':
          $HomeController->quit();

          break;
        default:
          if (isset($_SESSION["connecté"])) {

            $UtilisateurController->showDashboard();
          }
          break;
      }
    } else {
      header("location: " . HOME_URL);
      die;
    }
    break;

  default:
    $HomeController->page404();
    break;
}
