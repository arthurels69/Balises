<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Theater", inversedBy="user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $login;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?Theater
    {
        return $this->login;
    }

    public function setLogin(Theater $login): self
    {
        $this->login = $login;

        return $this;
    }
}
