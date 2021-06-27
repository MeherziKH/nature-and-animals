<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ConsultationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ConsultationRepository::class)
 */
class Consultation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="consultations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre_id;

    /**
     * @ORM\ManyToOne(targetEntity=Veterinaire::class, inversedBy="consultations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vet_id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $approved;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMembreId(): ?Membre
    {
        return $this->membre_id;
    }

    public function setMembreId(?Membre $membre_id): self
    {
        $this->membre_id = $membre_id;

        return $this;
    }

    public function getVetId(): ?Veterinaire
    {
        return $this->vet_id;
    }

    public function setVetId(?Veterinaire $vet_id): self
    {
        $this->vet_id = $vet_id;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getApproved(): ?string
    {
        return $this->approved;
    }

    public function setApproved(string $approved): self
    {
        $this->approved = $approved;

        return $this;
    }
}
