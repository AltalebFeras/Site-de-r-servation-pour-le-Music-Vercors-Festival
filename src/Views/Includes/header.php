<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire de réservation Music Vercors Festival</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="/assets/style/style.css">
  <!-- le css à verifier pour le repartir -->
  <link rel="stylesheet" href="<?= HOME_URL ?>assets/css/main.css">
  <link rel="stylesheet" href="<?= HOME_URL ?>assets/css/form.css">
  <?php if (isset($_SESSION['connecté'])) { ?>
    <link rel="stylesheet" href="<?= HOME_URL ?>assets/css/dashboard.css">
    <script src="<?= HOME_URL ?>assets/scripts/dashboard.js" defer></script>
<?php } else { ?>
    <script src="<?= HOME_URL ?>assets/scripts/script.js" defer></script>
<?php } ?>

</head>

<body>

  <div id="header">
    <?php if (isset($_SESSION['connecté'])) { ?>
      <a href="deconnexion" class="btn btn-info" >Déconnexion</a>
    <?php } else { ?>
      <a   href="connexion" class="btn btn-info">Connexion</a>

      <a href="/"><img src="/assets/images/logo.png"  class="logo"  alt="Vercors Music Festival"></a>

      <a   href="admin" class="btn btn-info">Admin</a>
    <?php } ?>
  </div>