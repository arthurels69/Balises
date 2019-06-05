<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParamRepository")
 */
class Param
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Resale coefficient of tickets
     * @ORM\Column(type="float")
     */
    private $resale_coeff;

    /**
     * Redistributed coefficient for Balises
     * @ORM\Column(type="float")
     */
    private $redistributed_coeff;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResaleCoeff(): ?float
    {
        return $this->resale_coeff;
    }

    public function setResaleCoeff(float $resale_coeff): self
    {
        $this->resale_coeff = $resale_coeff;

        return $this;
    }

    public function getRedistributedCoeff(): ?float
    {
        return $this->redistributed_coeff;
    }

    public function setRedistributedCoeff(float $redistributed_coeff): self
    {
        $this->redistributed_coeff = $redistributed_coeff;

        return $this;
    }
}
