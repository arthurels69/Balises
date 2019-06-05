<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TheaterRepository")
 */
class Theater
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Name of the theater
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * Email of the theater
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * First address line, mandatory
     * @ORM\Column(type="string", length=255)
     */
    private $address1;

    /**
     * 2nd address line, optional
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address2;

    /**
     * Zip code (aka code postal)
     * @ORM\Column(type="integer")
     */
    private $zipCode;

    /**
     * City
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * PhoneNumber
     * @ORM\Column(type="string", length=255)
     */
    private $phoneNumber;

    /**
     * Logo
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    /**
     * Website
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * Base Rate
     * @ORM\Column(type="float")
     */
    private $baseRate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Show", mappedBy="theater")
     */
    private $shows;

    public function __construct()
    {
        $this->shows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getBaseRate(): ?float
    {
        return $this->baseRate;
    }

    public function setBaseRate(float $baseRate): self
    {
        $this->baseRate = $baseRate;

        return $this;
    }

    /**
     * @return Collection|Show[]
     */
    public function getShows(): Collection
    {
        return $this->shows;
    }

    public function addShow(Show $show): self
    {
        if (!$this->shows->contains($show)) {
            $this->shows[] = $show;
            $show->setTheater($this);
        }

        return $this;
    }

    public function removeShow(Show $show): self
    {
        if ($this->shows->contains($show)) {
            $this->shows->removeElement($show);
            // set the owning side to null (unless already changed)
            if ($show->getTheater() === $this) {
                $show->setTheater(null);
            }
        }

        return $this;
    }
}
