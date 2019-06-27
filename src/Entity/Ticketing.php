<?php


namespace App\Entity;

use Mapado\RestClientSdk\Mapping\Annotations as Rest;

/**
 * Class Ticketing
 * @package App\Entity
 * @Rest\Entity(key="ticketing")
 */
class Ticketing
{
    private $theaterName;

    private $dateSpectacle;

    private $ticketPrice;

    private $nbrAvailableSeats;

    /**
     * @return mixed
     */
    public function getTheaterName()
    {
        return $this->theaterName;
    }

    /**
     * @param mixed $theaterName
     */
    public function setTheaterName($theaterName): void
    {
        $this->theaterName = $theaterName;
    }

    /**
     * @return mixed
     */
    public function getDateSpectacle()
    {
        return $this->dateSpectacle;
    }

    /**
     * @param mixed $dateSpectacle
     */
    public function setDateSpectacle($dateSpectacle): void
    {
        $this->dateSpectacle = $dateSpectacle;
    }

    /**
     * @return mixed
     */
    public function getTicketPrice()
    {
        return $this->ticketPrice;
    }

    /**
     * @param mixed $ticketPrice
     */
    public function setTicketPrice($ticketPrice): void
    {
        $this->ticketPrice = $ticketPrice;
    }

    /**
     * @return mixed
     */
    public function getNbrAvailableSeats()
    {
        return $this->nbrAvailableSeats;
    }

    /**
     * @param mixed $nbrAvailableSeats
     */
    public function setNbrAvailableSeats($nbrAvailableSeats): void
    {
        $this->nbrAvailableSeats = $nbrAvailableSeats;
    }
}
