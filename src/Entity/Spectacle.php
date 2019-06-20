<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpectacleRepository")
 */
class Spectacle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Name of the show
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * Description of the show
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * Distribution of the show
     * @ORM\Column(type="text")
     */
    private $distribution;

    /**
     * MandatoryInfos (aka Mentions Légales)
     * @ORM\Column(type="text", nullable=true)
     */
    private $mandatoryInfos;

    /**
     * Visual for the show
     * @Assert\File(mimeTypes={ "image/png","image/jpg","image/gif"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * Photo credits for the show.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoCredits;

    /**
     * Additional informations
     * @ORM\Column(type="text", nullable=true)
     */
    private $additionalInfos;

    /**
     * Check if there's a Balises offer
     * @ORM\Column(type="boolean")
     */
    private $isBalise;

    /**
     * Choice between reduced tickets and given tickets, if isBalise is true
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $offerType;

    /**
     * Link to the mapado page of the selected show
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mapadoLink;

    /**
     * Base rate of the show to make calculations
     * @Assert\Regex( "/^[0-9]{1,}(\.|)[0-9]{0,2}$/", message =" tarif non valide")
     * @ORM\Column(type="float", nullable=true)
     */
    private $baseRate;

    /**
     * Many to one relation with the theater the show is linked to
     * @ORM\ManyToOne(targetEntity="App\Entity\Theater", inversedBy="shows")
     * @ORM\JoinColumn(nullable=false, name="theater_id_id")
     */
    private $theater;

    /**
     * One to many relation to the many dates a show can have
     * @ORM\OneToMany(targetEntity="App\Entity\ShowDate", mappedBy="showId")
     */
    private $showDates;

    public function __construct()
    {
        $this->showDates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDistribution(): ?string
    {
        return $this->distribution;
    }

    public function setDistribution(string $distribution): self
    {
        $this->distribution = $distribution;

        return $this;
    }

    public function getMandatoryInfos(): ?string
    {
        return $this->mandatoryInfos;
    }

    public function setMandatoryInfos(?string $mandatoryInfos): self
    {
        $this->mandatoryInfos = $mandatoryInfos;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPhotoCredits(): ?string
    {
        return $this->photoCredits;
    }

    public function setPhotoCredits(?string $photoCredits): self
    {
        $this->photoCredits = $photoCredits;

        return $this;
    }

    public function getAdditionalInfos(): ?string
    {
        return $this->additionalInfos;
    }

    public function setAdditionalInfos(?string $additionalInfos): self
    {
        $this->additionalInfos = $additionalInfos;

        return $this;
    }

    public function getIsBalise(): ?bool
    {
        return $this->isBalise;
    }

    public function setIsBalise(bool $isBalise): self
    {
        $this->isBalise = $isBalise;

        return $this;
    }

    public function getOfferType(): ?int
    {
        return $this->offerType;
    }

    public function setOfferType(?int $offerType): self
    {
        $this->offerType = $offerType;

        return $this;
    }

    public function getMapadoLink(): ?string
    {
        return $this->mapadoLink;
    }

    public function setMapadoLink(?string $mapadoLink): self
    {
        $this->mapadoLink = $mapadoLink;

        return $this;
    }

    public function getBaseRate(): ?float
    {
        return $this->baseRate;
    }

    public function setBaseRate(?float $baseRate): self
    {
        $this->baseRate = $baseRate;

        return $this;
    }

    public function getTheater(): ?Theater
    {
        return $this->theater;
    }

    public function setTheater(?Theater $theater): self
    {
        $this->theater = $theater;

        return $this;
    }

    /**
     * @return Collection|ShowDate[]
     */
    public function getShowDates(): Collection
    {
        return $this->showDates;
    }

    public function addShowDate(ShowDate $showDate): self
    {
        if (!$this->showDates->contains($showDate)) {
            $this->showDates[] = $showDate;
            $showDate->setShowId($this);
        }

        return $this;
    }

    public function removeShowDate(ShowDate $showDate): self
    {
        if ($this->showDates->contains($showDate)) {
            $this->showDates->removeElement($showDate);
            // set the owning side to null (unless already changed)
            if ($showDate->getShowId() === $this) {
                $showDate->setShowId(null);
            }
        }

        return $this;
    }
}
