<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(normalizationContext= {"groups" = {"read"}}))
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */


class Type
{
    /**
     * @ORM\Id
     * @Groups("read")
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @Groups("read")
     * @ORM\Column(type="boolean")
     */
    private $refAnimal;

    /**
     * @Groups("read")
     * @ORM\Column(type="boolean")
     */
    private $image;

    /**
     * @Groups("read")
     * @ORM\Column(type="boolean")
     */
    private $lieu;

    /**
     * @Groups("read")
     * @ORM\Column(type="boolean")
     */
    private $file;

    /**
     * @Groups("read")
     * @ORM\OneToMany(targetEntity=Publication::class, mappedBy="type")
     */
    private $publications;

    public function __construct()
    {
        $this->publications = new ArrayCollection();
    }

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

    /**
     * @Groups("read")
     * @return Collection|Publication[]
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): self
    {
        if (!$this->publications->contains($publication)) {
            $this->publications[] = $publication;
            $publication->setType($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): self
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getType() === $this) {
                $publication->setType(null);
            }
        }

        return $this;
    }
}
