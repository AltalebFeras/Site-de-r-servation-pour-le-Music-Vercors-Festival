<?php
include_once __DIR__ . '/Includes/header.php';
include_once __DIR__ . '/Includes/colonne.php';

if ($_SESSION['role'] == 'user') {
    echo '<div>
            <a href="dashboard/reservation" class="btn btn-info">Ma réservation</a>
            <a href="dashboard/compte" class="btn btn-info">Mon compte</a>
          </div>';


?>

<div id="message">
    <?php
    if (isset( $_SESSION['message']) 
    ) {
        echo '<div class="alert bg-success" role="alert">' . $_SESSION['message'] . '</div>';
        echo '<div>
                <p>Merci pour votre réservation ! Cliquez sur le <a href="dashboard/reservation">lien</a> pour voir tous les détails de votre réservation.</p>
            </div>';
        unset($_SESSION['message']);
    }
    ?>
</div>

   



<div>
        <p class="fs-3 my-4">  Cliquez sur le
            <a  href="createReservation">👉ICI👈</a>
            pour creér une réservation.
        </p>
    </div>
<?php } ?>
<?php
include_once __DIR__ . '/Includes/footer.php';
?>
