<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;             
use App\Repository\PublicationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 * normalizationContext= {"groups" = {"read"}},
 *      collectionOperations={"get","post"},
 *      itemOperations={
 *          "get",
 *          "post"= {
 *              "method"="POST",
 *              "path"="/publications",
 *              "controller"=PublicationController::class,
 *          }
 *      },
 *      
 * )
 * @ORM\Entity(repositoryClass=PublicationRepository::class)
 */


class Publication
{
    /**
    * @Groups("read")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @Groups("read")
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @Groups("read")
     * @ORM\OneToOne(targetEntity=Animal::class, cascade={"persist", "remove"})
     */
    private $id_animal;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @Groups("read")
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="idPublication")
     */
    private $membre;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="publications")
     */
    private $type;


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

    /**
     * @Groups("read")
     */
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

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
