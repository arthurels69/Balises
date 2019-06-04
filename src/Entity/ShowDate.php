<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\JoinColumn(nullable=false)
     */
    private $show_id;

    /**
     * Rate used if a date is concerned by a Balises offer
     * @ORM\OneToMany(targetEntity="App\Entity\ShowRate", mappedBy="showDate")
     */
    private $showRates;

    public function __construct()
    {
        $this->showRates = new ArrayCollection();
    }

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
        return $this->show_id;
    }

    public function setShowId(?Show $show_id): self
    {
        $this->show_id = $show_id;

        return $this;
    }

    /**
     * @return Collection|ShowRate[]
     */
    public function getShowRates(): Collection
    {
        return $this->showRates;
    }

    public function addShowRate(ShowRate $showRate): self
    {
        if (!$this->showRates->contains($showRate)) {
            $this->showRates[] = $showRate;
            $showRate->setShowDate($this);
        }

        return $this;
    }

    public function removeShowRate(ShowRate $showRate): self
    {
        if ($this->showRates->contains($showRate)) {
            $this->showRates->removeElement($showRate);
            // set the owning side to null (unless already changed)
            if ($showRate->getShowDate() === $this) {
                $showRate->setShowDate(null);
            }
        }

        return $this;
    }
}
