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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $freePlacesNumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $discountedRate;

    /**
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
