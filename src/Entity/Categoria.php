<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriaRepository")
 */
class Categoria
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
     * @ORM\Column(type="text")
     * @Assert\NotNull
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Incidencia", mappedBy="categoria")
     * @Assert\Valid
     */
    private $incidencias;

    public function __construct()
    {
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
     * @return Collection|Incidencia[]
     */
    public function getIncidencias(): Collection
    {
        return $this->incidencias;
    }

    public function addIncidencia(Incidencia $incidencia): self
    {
        if (!$this->incidencias->contains($incidencia)) {
            $this->incidencias[] = $incidencia;
            $incidencia->setCategoria($this);
        }

        return $this;
    }

    public function removeIncidencia(Incidencia $incidencia): self
    {
        if ($this->incidencias->contains($incidencia)) {
            $this->incidencias->removeElement($incidencia);
            // set the owning side to null (unless already changed)
            if ($incidencia->getCategoria() === $this) {
                $incidencia->setCategoria(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getName();
    }
}
