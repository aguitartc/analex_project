<?php

namespace App\Entity;

use App\Repository\PersonaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PersonaRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Persona
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     * @Assert\NotBlank
     */
    private $tipus_ident;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank
     */
    private $ident;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $cognoms;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    private $data_alta;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="persones")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     */
    private $department;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipusIdent(): ?string
    {
        return $this->tipus_ident;
    }

    public function setTipusIdent(string $tipus_ident): self
    {
        $this->tipus_ident = $tipus_ident;

        return $this;
    }

    public function getIdent(): ?string
    {
        return $this->ident;
    }

    public function setIdent(string $ident): self
    {
        $this->ident = $ident;

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

    public function getCognoms(): ?string
    {
        return $this->cognoms;
    }

    public function setCognoms(string $cognoms): self
    {
        $this->cognoms = $cognoms;

        return $this;
    }

    public function getDataAlta(): ?\DateTimeInterface
    {
        return $this->data_alta;
    }

    public function setDataAlta(\DateTimeInterface $data_alta): self
    {
        $this->data_alta = $data_alta;

        return $this;
    }
    /**
     * @ORM\PrePersist
     */
    public function setDataAltaValue()
    {
        $this->data_alta = new \DateTime();
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
