<?php

namespace src\Models;

use src\Services\Hydratation;

class Reservation
{
    private $reservationID;
    private $nombreReservations;
    private $prixTotal;
    private $utilisateurID;

    use Hydratation;



    /**
     * Get the value of reservationID
     *
     * @return  mixed
     */
    public function getReservationID()
    {
        return $this->reservationID;
    }

    /**
     * Set the value of reservationID
     *
     * @param   mixed  $reservationID  
     *
     */
    public function setReservationID($reservationID)
    {
        $this->reservationID = $reservationID;
    }

    /**
     * Get the value of nombreReservation
     *
     * @return  mixed
     */
   

    /**
     * Get the value of prixTotal
     *
     * @return  mixed
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * Set the value of prixTotal
     *
     * @param   mixed  $prixTotal  
     *
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;
        // return $this->prixTotal =$totalPrice;
    }


    /**
     * Get the value of utilisateurID
     *
     * @return  mixed
     */
    public function getUtilisateurID()
    {
        return $this->utilisateurID;
    }

    /**
     * Set the value of utilisateurID
     *
     * @param   mixed  $utilisateurID  
     *
     */
    public function setUtilisateurID($utilisateurID)
    {
        $this->utilisateurID = $utilisateurID;
        // return  $this->utilisateurID = $_SESSION['$utilisateur'];
    }

    /**
     * Get the value of nombreReservations
     *
     * @return  mixed
     */
    public function getNombreReservations()
    {
        return $this->nombreReservations;
    }

    /**
     * Set the value of nombreReservations
     *
     * @param   mixed  $nombreReservations  
     *
     */
    public function setNombreReservations($nombreReservations)
    {
        $this->nombreReservations = $nombreReservations;

    }
}
