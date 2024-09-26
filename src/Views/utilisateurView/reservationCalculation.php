<?php
$numberOfReservations = intval($_POST["nombreReservations"]);

//   Chosen Passes
$pass1jourPrice = 40;
$pass2joursPrice = 70;
$pass3joursPrice = 100;
$totalPassPrice = 0;

$tarifReduitChecked = isset($_POST["tarifReduit"]);
$tarifReduitPass1jourPrice = 25;
$tarifReduitPass2joursPrice = 50;
$tarifReduitPass3joursPrice = 65;

if ($tarifReduitChecked) {
    if ($_POST["choixPassReduit"] == "pass1jourreduit")
        $totalPassPrice += $tarifReduitPass1jourPrice;
    if ($_POST["choixPassReduit"] == "pass2joursreduit")
        $totalPassPrice += $tarifReduitPass2joursPrice;
    if ($_POST["choixPassReduit"] == "pass3joursreduit")
        $totalPassPrice += $tarifReduitPass3joursPrice;
}else{

if ($_POST["choixPass"] == "pass1jour")
    $totalPassPrice += $pass1jourPrice;
if ($_POST["choixPass"] == "pass2jours")
    $totalPassPrice += $pass2joursPrice;
if ($_POST["choixPass"] == "pass3jours")
    $totalPassPrice += $pass3joursPrice;
}
//   Optional Extras

$tentPrice = 5;
$vanPrice = 5;
$tent3NuitsPrice = 12;
$van3NuitsPrice = 12;
$enfantsCasquePrice = 2;
$lugePrice = 5;
$totalExtrasPrice = 0;

// Check if any tenteNuit option is selected and calculate the total tent price accordingly
if (isset($_POST["tenteNuit1"]) || isset($_POST["tenteNuit2"]) || isset($_POST["tenteNuit3"])) {
    $numberOfTenteNuits = 0;
    if (isset($_POST["tenteNuit1"])) $numberOfTenteNuits++;
    if (isset($_POST["tenteNuit2"])) $numberOfTenteNuits++;
    if (isset($_POST["tenteNuit3"])) $numberOfTenteNuits++;
    $totalExtrasPrice += $tentPrice * $numberOfTenteNuits;
}

if (isset($_POST["vanNuit1"]) || isset($_POST["vanNuit2"]) || isset($_POST["vanNuit3"])) {
    $numberOfVanNuits = 0;
    if (isset($_POST["vanNuit1"])) $numberOfVanNuits++;
    if (isset($_POST["vanNuit2"])) $numberOfVanNuits++;
    if (isset($_POST["vanNuit3"])) $numberOfVanNuits++;
    $totalExtrasPrice += $vanPrice * $numberOfVanNuits;
}
if (isset($_POST["tente3Nuits"]))
    $totalExtrasPrice += $tent3NuitsPrice;
if (isset($_POST["van3Nuits"]))
    $totalExtrasPrice += $van3NuitsPrice;
if (isset($_POST["nombreCasquesEnfants"]))
    $totalExtrasPrice += intval($_POST["nombreCasquesEnfants"]) * $enfantsCasquePrice;
if (isset($_POST["NombreLugesEte"]))
    $totalExtrasPrice += intval($_POST["NombreLugesEte"]) * $lugePrice;


// Total Calculation
$totalPrice = ($totalPassPrice + $totalExtrasPrice) * $numberOfReservations;

echo "Total Price: " . $totalPrice . "€";

