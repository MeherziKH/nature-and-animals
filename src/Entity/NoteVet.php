<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NoteVetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=NoteVetRepository::class)
 */
class NoteVet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="noteVets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre_id;

    /**
     * @ORM\ManyToOne(targetEntity=Veterinaire::class, inversedBy="noteVets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vet_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $note;

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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }
}
