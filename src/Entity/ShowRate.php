<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShowRateRepository")
 */
class ShowRate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Number of tickets given by a theater for a show
     * @ORM\Column(type="integer", nullable=true)
     */
    private $freePlacesNumber;

    /**
     * Display the discounted Rate for the show if this offer has been chosen.
     * @ORM\Column(type="integer", nullable=true)
     */
    private $discountedRate;

    /**
     * Many to one relation to a show date since a date can be concerned by the Balises offer and an other might not be.
     * @ORM\ManyToOne(targetEntity="App\Entity\ShowDate", inversedBy="showRates")
     */
    private $showDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFreePlacesNumber(): ?int
    {
        return $this->freePlacesNumber;
    }

    public function setFreePlacesNumber(?int $freePlacesNumber): self
    {
        $this->freePlacesNumber = $freePlacesNumber;

        return $this;
    }

    public function getDiscountedRate(): ?int
    {
        return $this->discountedRate;
    }

    public function setDiscountedRate(?int $discountedRate): self
    {
        $this->discountedRate = $discountedRate;

        return $this;
    }

    public function getShowDate(): ?ShowDate
    {
        return $this->showDate;
    }

    public function setShowDate(?ShowDate $showDate): self
    {
        $this->showDate = $showDate;

        return $this;
    }
}
