<?php

namespace src\Models;

use src\Services\Hydratation;

class Reservation_pass
{
    private $jour;
    private $passID;
    private $reservationID;
    use Hydratation;

    /**
     * Get the value of jour
     *
     * @return  mixed
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set the value of jour
     *
     * @param   mixed  $jour  
     *
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

    }
}
