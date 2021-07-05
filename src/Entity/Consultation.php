<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ConsultationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext= {"groups" = {"read"}})
 *         collectionOperations={"get", "post"},
 *         itemOperations={"get", "put", "delete"},
 * )
 * @ORM\Entity(repositoryClass=ConsultationRepository::class)
 */
class Consultation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups("read")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read")
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read")
     */
    private $approved;

    /**
     *
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="consultations")
     * @Groups("read")
     */
    private $membre;

    /**
     * @ORM\ManyToOne(targetEntity=Veterinaire::class, inversedBy="consultations")
     * @Groups("read")
     */
    private $vet;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    public function getVet(): ?Veterinaire
    {
        return $this->vet;
    }

    public function setVet(?Veterinaire $vet): self
    {
        $this->vet = $vet;

        return $this;
    }
}
