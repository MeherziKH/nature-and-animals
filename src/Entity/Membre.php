<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(normalizationContext= {"groups" = {"read"}})
 * @ORM\Entity(repositoryClass=MembreRepository::class)
 */
class Membre
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
    private $prenom;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=Publication::class, mappedBy="membre")
     */
    private $idPublication;

    /**
     * @ORM\OneToMany(targetEntity=NoteVet::class, mappedBy="membre_id")
     */
    private $noteVets;

    /**
     * @ORM\OneToMany(targetEntity=Consultation::class, mappedBy="membre")
     */
    private $consultations;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="membre")
     */
    private $ordres;

    public function __construct()
    {
        $this->consultations = new ArrayCollection();
        $this->noteVets = new ArrayCollection();
        $this->ordres = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

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
     * @return Collection|Publication[]
     */
    public function getIdPublication(): Collection
    {
        return $this->idPublication;
    }

    public function addIdPublication(Publication $idPublication): self
    {
        if (!$this->idPublication->contains($idPublication)) {
            $this->idPublication[] = $idPublication;
            $idPublication->setMembre($this);
        }

        return $this;
    }

    public function removeIdPublication(Publication $idPublication): self
    {
        if ($this->idPublication->removeElement($idPublication)) {
            // set the owning side to null (unless already changed)
            if ($idPublication->getMembre() === $this) {
                $idPublication->setMembre(null);
            }
        }

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
            $noteVet->setMembreId($this);
        }
            return $this;
        }
    
     /**
     * @return Collection|Order[]
     */
    public function getOrdres(): Collection
    {
        return $this->ordres;
    }

    public function addOrdre(Order $ordre): self
    {
        if (!$this->ordres->contains($ordre)) {
            $this->ordres[] = $ordre;
            $ordre->setMembre($this);
        }

        return $this;
    }

    public function removeNoteVet(NoteVet $noteVet): self
    {
        if ($this->noteVets->removeElement($noteVet)) {
            // set the owning side to null (unless already changed)
            if ($noteVet->getMembreId() === $this) {
                $noteVet->setMembreId(null);
            }
    }

        return $this;
    }

    public function removeOrdre(Order $ordre): self
    {
        if ($this->ordres->removeElement($ordre)) {
            // set the owning side to null (unless already changed)
            if ($ordre->getMembre() === $this) {
                $ordre->setMembre(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return(string)$this->getId();
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
            $consultation->setMembre($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getMembre() === $this) {
                $consultation->setMembre(null);
            }
        }

        return $this;
    }


}
