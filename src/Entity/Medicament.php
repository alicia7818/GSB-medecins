<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Medicament
 *
 * @ORM\Table(name="medicament", indexes={@ORM\Index(name="medicament_fk", columns={"idFamille"})})
 * @ORM\Entity
 */
class Medicament
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=30, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCommercial", type="string", length=80, nullable=false)
     */
    private $nomcommercial;

    /**
     * @var string
     *
     * @ORM\Column(name="composition", type="string", length=100, nullable=false)
     */
    private $composition;

    /**
     * @var string
     *
     * @ORM\Column(name="effets", type="string", length=100, nullable=false)
     */
    private $effets;

    /**
     * @var string
     *
     * @ORM\Column(name="contreIndications", type="string", length=100, nullable=false)
     */
    private $contreindications;

    /**
     * @var \Famille
     *
     * @ORM\ManyToOne(targetEntity="Famille")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFamille", referencedColumnName="id")
     * })
     */
    private $idfamille;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNomcommercial(): ?string
    {
        return $this->nomcommercial;
    }

    public function setNomcommercial(string $nomcommercial): self
    {
        $this->nomcommercial = $nomcommercial;

        return $this;
    }

    public function getComposition(): ?string
    {
        return $this->composition;
    }

    public function setComposition(string $composition): self
    {
        $this->composition = $composition;

        return $this;
    }

    public function getEffets(): ?string
    {
        return $this->effets;
    }

    public function setEffets(string $effets): self
    {
        $this->effets = $effets;

        return $this;
    }

    public function getContreindications(): ?string
    {
        return $this->contreindications;
    }

    public function setContreindications(string $contreindications): self
    {
        $this->contreindications = $contreindications;

        return $this;
    }

    public function getIdfamille(): ?Famille
    {
        return $this->idfamille;
    }

    public function setIdfamille(?Famille $idfamille): self
    {
        $this->idfamille = $idfamille;

        return $this;
    }
}
