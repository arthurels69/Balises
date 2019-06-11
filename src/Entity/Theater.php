<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

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
     * @Assert\NotBlank()

     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * Email of the theater
     * @Assert\NotBlank()

     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * First address line, mandatory
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address1;

    /**
     * 2nd address line, optional
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address2;

    /**
     * @Assert\Regex("/^[0-9]{5}$/")
     * @Assert\Length (
     *      max = 5,
     *      maxMessage = "code postal 5 chiffres maximum"
     * )
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zipCode;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;


    //pattern="/(0|\+33)[1-9]( *[0-9]{2}){4}/"
    /**
     * @Assert\Regex("/(\+\d+(\s|-))?0\d(\s|-)?(\d{2}(\s|-)?){4}/",
     *      message =" formats : +33 xx xx xx xx xx, +33xxxxxxxxxx, xxxxxxxxxx, xx-xx-xx-xx-xx")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneNumber;


    /**
     * @Assert\Regex("#https?://[a-zA-Z0-9-\.]+\.[a-zA-Z]{2,4}(/\S*)?#")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @Assert\Regex("#https?://[a-zA-Z0-9-\.]+\.[a-zA-Z]{2,4}(/\S*)?#")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @Assert\Regex("/^[0-9]{1,}[.]{0,1}[0-9]{0,2}$/")
     * @ORM\Column(type="float", nullable=true)
     */
    private $baseRate;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="theater", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Spectacle", mappedBy="theater_id", orphanRemoval=true)
     */
    private $shows;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitude;

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

    public function setBaseRate(?float $baseRate): self
    {
        $this->baseRate = $baseRate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Spectacle[]
     */
    public function getShows(): Collection
    {
        return $this->shows;
    }

    public function addShow(Spectacle $show): self
    {
        if (!$this->shows->contains($show)) {
            $this->shows[] = $show;
            $show->setTheaterId($this);
        }

        return $this;
    }

    public function removeShow(Spectacle $show): self
    {
        if ($this->shows->contains($show)) {
            $this->shows->removeElement($show);
            // set the owning side to null (unless already changed)
            if ($show->getTheaterId() === $this) {
                $show->setTheaterId(null);
            }
        }

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }
}
