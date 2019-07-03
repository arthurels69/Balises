<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;

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



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getfreePlacesNumber(): ?int
    {
        return $this->freePlacesNumber;
    }

    public function setfreePlacesNumber(?int $freePlacesNumber): self
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
}
