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
    private $date;

    /**
     * Many to one relation to the show each date relates to
     * @ORM\ManyToOne(targetEntity="App\Entity\Show", inversedBy="showDates")
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getShowId(): ?Show
    {
        return $this->showId;
    }

    public function setShowId(?Show $showId): self
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
