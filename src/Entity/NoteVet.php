<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NoteVetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "put", "delete"},
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 * )
 * @ORM\Entity(repositoryClass=NoteVetRepository::class)
 */
class NoteVet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read","write")
     */
    private $id;

    /**
     * @Groups("read","write")
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="noteVets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;

    /**
     * @Groups("read","write")
     * @ORM\ManyToOne(targetEntity=Veterinaire::class, inversedBy="noteVets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vet;

    /**
     * @Groups("read","write")
     * @ORM\Column(type="integer")
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMembreId(): ?Membre
    {
        return $this->membre;
    }

    public function setMembreId(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    public function getVetId(): ?Veterinaire
    {
        return $this->vet;
    }

    public function setVetId(?Veterinaire $vet): self
    {
        $this->vet = $vet;

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
