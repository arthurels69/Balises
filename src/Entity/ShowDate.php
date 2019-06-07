<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShowDateRepository")
 */
class ShowDate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateShow;

    /**
     * Many to one relation to the show each date relates to
     * @ORM\ManyToOne(targetEntity="spectacle", inversedBy="showDates")
     */
    private $showId;

    /**
     * Rate used if a date is concerned by a Balises offer
     * @ORM\OneToOne(targetEntity="App\Entity\ShowRate", mappedBy="show_date", cascade={"persist", "remove"})
     */
    private $showRate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateShow(): ?\DateTimeInterface
    {
        return $this->dateShow;
    }

    public function setDateShow(\DateTimeInterface $dateShow): self
    {
        $this->dateShow = $dateShow;

        return $this;
    }

    public function getShowId(): ?Spectacle
    {
        return $this->showId;
    }

    public function setShowId(?Spectacle $showId): self
    {
        $this->showId = $showId;

        return $this;
    }

    public function getShowRate(): ?ShowRate
    {
        return $this->showRate;
    }

    public function setShowRate(ShowRate $showRate): self
    {
        $this->showRate = $showRate;

        // set the owning side of the relation if necessary
        if ($this !== $showRate->getShowDate()) {
            $showRate->setShowDate($this);
        }

        return $this;
    }
}
