   <?php

    include_once __DIR__ . '/../Includes/header.php';

    include_once __DIR__ . '/../Includes/colonne.php';

    if (isset($_SESSION['connecté'])) {
        echo '<div><a href="/" class="btn btn-info">dashoard</a>';
    };
    ?>

   <form id="monCompteForm" action="" method="post">
       <fieldset class="d-flex flex-column ">
           <legend>Vos Coordonnées</legend>
           <label for="nom">Votre nom :</label>
           <input type="text" name="nom" id="nom
           " placeholder="<?php
                            $all = $utilisateurRepositories->getAllUtilisateurDetails($utilisateurID);
                            echo $all[0]['nom']
                            ?>
           
           " disabled>
           <label for="prenom">Votre prénom :</label>
           <input type="text" name="prenom" id="prenom
           " placeholder="<?php
                            $prenom = $utilisateurRepositories->getCoordonee($utilisateurID);
                            echo $all[0]['prenom']
                            ?>
           " disabled>
           <label for="email">Votre Email :</label>
           <input type="email" name="email" id="email
           " placeholder="<?php
                            $prenom = $utilisateurRepositories->getCoordonee($utilisateurID);
                            echo $all[0]['email']
                            ?>" disabled>
           <label for="telephone">Votre numéro de téléphone :</label>
           <input type="text" name="telephone" id="telephone
           " placeholder="<?php
                            $prenom = $utilisateurRepositories->getCoordonee($utilisateurID);
                            echo $all[0]['telephone']
                            ?>" disabled>
           <label for="adresse">Votre adresse postale :</label>
           <input type="text" name="adresse" id="adresse
           " placeholder="<?php
                            $prenom = $utilisateurRepositories->getCoordonee($utilisateurID);
                            echo $all[0]['adresse']
                            ?>" disabled>


           <!-- Button trigger modal -->
           <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
               supprimer mon compte
           </button>

           <!-- Modal -->
           <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="staticBackdropLabel">Confirme la suppression</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

                           <input type="submit" name="suppression" class="btn btn-danger" value="Valider">

                       </div>
                   </div>
               </div>
           </div>


       </fieldset>
   </form>

   <?php
    include_once __DIR__ . '/../Includes/footer.php';
