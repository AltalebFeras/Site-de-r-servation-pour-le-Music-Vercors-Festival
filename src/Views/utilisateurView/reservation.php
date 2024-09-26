<?php

use src\Repositories\ReservationRepositories;

include_once __DIR__ . '/../Includes/header.php';

include_once __DIR__ . '/../Includes/colonne.php';
if (isset($_SESSION['connecté'])) {
    echo '<div><a href="/" class="btn btn-info m-3">dashoard</a>';
};


// Assuming $ReservationRepositories is instantiated somewhere
$ReservationRepositories = new ReservationRepositories();


$ReservationRepositories->displayUserReservations();


// <?php
include_once __DIR__ . '/../Includes/footer.php';
