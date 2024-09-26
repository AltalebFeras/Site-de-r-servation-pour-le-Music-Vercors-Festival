<?php
include_once __DIR__ . '/Includes/header.php';

?>

<div id="message">
    <?php
    if (isset($_SESSION['error_message1'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message1'] . '</div>';
        unset($_SESSION['error_message1']);
    }
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert bg-success" role="alert">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    ?>
</div>

<form id="formSignIn" method="POST" class="d-flex flex-column bd-highlight mb-3 form-control" action="connexion">
    <fieldset id="fieldsetConnexion">
        <h1>Connectez-vous!</h1>
        <label for="email">Email :*</label>
        <input id="email" type="email" name="email" class="mb-3 mx-2" minlength="3" maxlength="80" placeholder="Enter your email" required>

        <label for="motDePasse">Mot de passe :*</label>
        <div>
            <input type="password" name="motDePasse" class="mb-3 mx-2" id="motDePasse" required>

            <input type="submit" class="btn btn-info" name="Se connecter" value="Se connecter">
        </div>
    </fieldset>
</form>

<?php
include_once __DIR__ . '/Includes/footer.php';
?>
