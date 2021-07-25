<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VeterinaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "put", "delete"},
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     paginationItemsPerPage=6
 * )
 * @ORM\Entity(repositoryClass=VeterinaireRepository::class)
 */
class Veterinaire
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
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @Groups("read","write")
     * @ORM\Column(type="string", length=255)
     */
    private $pwd;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read","write")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read","write")
     */
    private $prenom;

    /**
     * @Groups("read","write")
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @Groups("read","write")
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read","write")
     */
    private $lundi;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read","write")
     */
    private $mardi;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read","write")
     */
    private $mercredi;

    /**
     * @Groups("read","write")
     * @ORM\Column(type="string", length=255)
     */
    private $jeudi;

    /**
     * @Groups("read","write")
     * @ORM\Column(type="string", length=255)
     */
    private $vendredi;

    /**
     * @Groups("read","write")
     * @ORM\Column(type="string", length=255)
     */
    private $samedi;

    /**
     * @Groups("read","write")
     * @ORM\Column(type="string", length=255)
     */
    private $adrcabinet;

    /**
     * @Groups("read","write")
     * @ORM\Column(type="string", length=255)
     */
    private $numpro;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read","write")
     */
    private $numfixe;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read","write")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=NoteVet::class, mappedBy="vet_id")
     */
    private $noteVets;

    /**
     *
     * @ORM\OneToMany(targetEntity=Consultation::class, mappedBy="vet")
     */
    private $consultations;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read","write")
     */
    private $photo;

    /**
     * @Groups("read","write")
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="vet")
     */
    private $animals;

    public function __construct()
    {
        $this->consultations = new ArrayCollection();
        $this->noteVets = new ArrayCollection();
        $this->animals = new ArrayCollection();
    }

    /**
     * @Groups("read")
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @Groups("read")
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    public function setPwd(string $pwd): self
    {
        $this->pwd = $pwd;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getLundi(): ?string
    {
        return $this->lundi;
    }

    public function setLundi(string $lundi): self
    {
        $this->lundi = $lundi;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getMardi(): ?string
    {
        return $this->mardi;
    }

    public function setMardi(string $mardi): self
    {
        $this->mardi = $mardi;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getMercredi(): ?string
    {
        return $this->mercredi;
    }

    public function setMercredi(string $mercredi): self
    {
        $this->mercredi = $mercredi;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getJeudi(): ?string
    {
        return $this->jeudi;
    }

    public function setJeudi(string $jeudi): self
    {
        $this->jeudi = $jeudi;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getVendredi(): ?string
    {
        return $this->vendredi;
    }

    public function setVendredi(string $vendredi): self
    {
        $this->vendredi = $vendredi;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getSamedi(): ?string
    {
        return $this->samedi;
    }

    public function setSamedi(string $samedi): self
    {
        $this->samedi = $samedi;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getAdrCabinet(): ?string
    {
        return $this->adrcabinet;
    }

    public function setAdrCabinet(string $adrcabinet): self
    {
        $this->adrcabinet = $adrcabinet;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getNumPro(): ?string
    {
        return $this->numpro;
    }

    public function setNumPro(string $numpro): self
    {
        $this->numpro = $numpro;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getNumFixe(): ?string
    {
        return $this->numfixe;
    }

    public function setNumFixe(string $numfixe): self
    {
        $this->numfixe = $numfixe;

        return $this;
    }
    /**
     * @Groups("read")
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }


    /**
     * @return Collection|NoteVet[]
     */
    public function getNoteVets(): Collection
    {
        return $this->noteVets;
    }

    public function addNoteVet(NoteVet $noteVet): self
    {
        if (!$this->noteVets->contains($noteVet)) {
            $this->noteVets[] = $noteVet;
            $noteVet->setVetId($this);
        }

        return $this;
    }

    public function removeNoteVet(NoteVet $noteVet): self
    {
        if ($this->noteVets->removeElement($noteVet)) {
            // set the owning side to null (unless already changed)
            if ($noteVet->getVetId() === $this) {
                $noteVet->setVetId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Consultation[]
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): self
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations[] = $consultation;
            $consultation->setVet($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getVet() === $this) {
                $consultation->setVet(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this.$this->getPrenom();
    }
    /**
     * @Groups("read")
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Animal[]
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animals->contains($animal)) {
            $this->animals[] = $animal;
            $animal->setVet($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getVet() === $this) {
                $animal->setVet(null);
            }
        }

        return $this;
    }
}
