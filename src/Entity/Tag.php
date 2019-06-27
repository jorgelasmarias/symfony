<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max = 255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max = 255)
     */
    private $description;

    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="Incidencia", mappedBy="tags")
     * @Assert\Valid
     */
    private $incidencias;

    public function __construct() {
        $this->incidencias = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getIncidencias(): Collection
    {
        return $this->incidencias;
    }

    public function setIncidencias(Incidencia $incidencias): self
    {
        $this->incidencias = $incidencias;

        return $this;
    }


    public function __toString(){
        return $this->getName();
    }
}
