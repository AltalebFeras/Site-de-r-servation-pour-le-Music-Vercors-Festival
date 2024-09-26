<?php

namespace src\Repositories;

use src\Repositories\UtilisateurRepositories;
use src\Repositories\ReservationRepositories;

$utilisateurRepositories = new UtilisateurRepositories();
$ReservationRepositories = new ReservationRepositories();

?>
<div id="colonne">

  <?php
  if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
      echo "<h2>Bonjour Admin!</h2>";
      
      $ReservationRepositories->displayAllReservations();




    } elseif ($_SESSION['role'] == 'user') {
      $utilisateurID = $_SESSION['utilisateur'];
      $prenom = $utilisateurRepositories->getCoordonee($utilisateurID);
      echo "<h2>Bonjour $prenom!</h2>";
      
     
    }
  }
  ?>


</div>