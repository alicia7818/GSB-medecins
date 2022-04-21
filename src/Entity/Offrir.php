<?php

namespace App\Entity;

use App\Repository\OffrirRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffrirRepository::class)
 */
class Offrir
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Rapport::class, inversedBy="offrirs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idRapport;

    /**
     * @ORM\ManyToOne(targetEntity=Medicament::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idMedicament;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRapport(): ?Rapport
    {
        return $this->idRapport;
    }

    public function setIdRapport(?Rapport $idRapport): self
    {
        $this->idRapport = $idRapport;

        return $this;
    }

    public function getIdMedicament(): ?Medicament
    {
        return $this->idMedicament;
    }

    public function setIdMedicament(?Medicament $idMedicament): self
    {
        $this->idMedicament = $idMedicament;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
