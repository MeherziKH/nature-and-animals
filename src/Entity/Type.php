<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $refAnimal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $lieu;

    /**
     * @ORM\Column(type="boolean")
     */
    private $file;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRefAnimal(): ?bool
    {
        return $this->refAnimal;
    }

    public function setRefAnimal(bool $refAnimal): self
    {
        $this->refAnimal = $refAnimal;

        return $this;
    }

    public function getImage(): ?bool
    {
        return $this->image;
    }

    public function setImage(bool $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLieu(): ?bool
    {
        return $this->lieu;
    }

    public function setLieu(bool $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getFile(): ?bool
    {
        return $this->file;
    }

    public function setFile(bool $file): self
    {
        $this->file = $file;

        return $this;
    }
}
