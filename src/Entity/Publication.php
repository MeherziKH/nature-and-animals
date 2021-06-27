<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;             
use App\Repository\PublicationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *      collectionOperations={"get","post"},
 *      itemOperations={
 *          "get",
 *          "post"= {
 *              "method"="POST",
 *              "path"="/publications",
 *              "controller"=PublicationController::class,
 *              "normalization_context"={"groups"={"publication"}},
 *          }
 *      },
 *      
 * )
 * @ORM\Entity(repositoryClass=PublicationRepository::class)
 */

class Publication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("publication")
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @Groups("publication")
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ApiSubresource
     * @Groups("publication")
     * @ORM\OneToOne(targetEntity=Animal::class, cascade={"persist", "remove"})
     */
    private $id_animal;

    /**
     * @Groups("publication")
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="idPublication")
     */
    private $membre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdAnimal(): ?Animal
    {
        return $this->id_animal;
    }

    public function setIdAnimal(?Animal $id_animal): self
    {
        $this->id_animal = $id_animal;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }
}
