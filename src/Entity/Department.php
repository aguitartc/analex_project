<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartmentRepository::class)
 */
class Department
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $codi_upc;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $sigles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Persona::class, mappedBy="department")
     */
    private $persones;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $nom_curt;

    public function __construct()
    {
        $this->persones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodiUpc(): ?string
    {
        return $this->codi_upc;
    }

    public function setCodiUpc(string $codi_upc): self
    {
        $this->codi_upc = $codi_upc;

        return $this;
    }

    public function getSigles(): ?string
    {
        return $this->sigles;
    }

    public function setSigles(string $sigles): self
    {
        $this->sigles = $sigles;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Persona[]
     */
    public function getPersones(): Collection
    {
        return $this->persones;
    }

    public function addPersone(Persona $persone): self
    {
        if (!$this->persones->contains($persone)) {
            $this->persones[] = $persone;
            $persone->setDepartment($this);
        }

        return $this;
    }

    public function removePersone(Persona $persone): self
    {
        if ($this->persones->removeElement($persone)) {
            // set the owning side to null (unless already changed)
            if ($persone->getDepartment() === $this) {
                $persone->setDepartment(null);
            }
        }

        return $this;
    }

    public function getNomCurt(): ?string
    {
        return $this->nom_curt;
    }

    public function setNomCurt(?string $nom_curt): self
    {
        $this->nom_curt = $nom_curt;

        return $this;
    }
}
