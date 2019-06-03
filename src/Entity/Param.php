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
     * @ORM\Column(type="float")
     */
    private $resaleCoeff;

    /**
     * @ORM\Column(type="float")
     */
    private $redistributedCoeff;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResaleCoeff(): ?float
    {
        return $this->resaleCoeff;
    }

    public function setResaleCoeff(float $resaleCoeff): self
    {
        $this->resaleCoeff = $resaleCoeff;

        return $this;
    }

    public function getRedistributedCoeff(): ?float
    {
        return $this->redistributedCoeff;
    }

    public function setRedistributedCoeff(float $redistributedCoeff): self
    {
        $this->redistributedCoeff = $redistributedCoeff;

        return $this;
    }
}
