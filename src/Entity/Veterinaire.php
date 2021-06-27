<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VeterinaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=VeterinaireRepository::class)
 */
class Veterinaire
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
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pwd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lundi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mardi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mercredi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jeudi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vendredi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $samedi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adr_cabinet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_pro;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_fixe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Consultation::class, mappedBy="vet_id")
     */
    private $consultations;

    /**
     * @ORM\OneToMany(targetEntity=NoteVet::class, mappedBy="vet_id")
     */
    private $noteVets;

    public function __construct()
    {
        $this->consultations = new ArrayCollection();
        $this->noteVets = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    public function setPwd(string $pwd): self
    {
        $this->pwd = $pwd;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getLundi(): ?string
    {
        return $this->lundi;
    }

    public function setLundi(string $lundi): self
    {
        $this->lundi = $lundi;

        return $this;
    }

    public function getMardi(): ?string
    {
        return $this->mardi;
    }

    public function setMardi(string $mardi): self
    {
        $this->mardi = $mardi;

        return $this;
    }

    public function getMercredi(): ?string
    {
        return $this->mercredi;
    }

    public function setMercredi(string $mercredi): self
    {
        $this->mercredi = $mercredi;

        return $this;
    }

    public function getJeudi(): ?string
    {
        return $this->jeudi;
    }

    public function setJeudi(string $jeudi): self
    {
        $this->jeudi = $jeudi;

        return $this;
    }

    public function getVendredi(): ?string
    {
        return $this->vendredi;
    }

    public function setVendredi(string $vendredi): self
    {
        $this->vendredi = $vendredi;

        return $this;
    }

    public function getSamedi(): ?string
    {
        return $this->samedi;
    }

    public function setSamedi(string $samedi): self
    {
        $this->samedi = $samedi;

        return $this;
    }

    public function getAdrCabinet(): ?string
    {
        return $this->adr_cabinet;
    }

    public function setAdrCabinet(string $adr_cabinet): self
    {
        $this->adr_cabinet = $adr_cabinet;

        return $this;
    }

    public function getNumPro(): ?string
    {
        return $this->num_pro;
    }

    public function setNumPro(string $num_pro): self
    {
        $this->num_pro = $num_pro;

        return $this;
    }

    public function getNumFixe(): ?string
    {
        return $this->num_fixe;
    }

    public function setNumFixe(string $num_fixe): self
    {
        $this->num_fixe = $num_fixe;

        return $this;
    }

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
            $consultation->setVetId($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getVetId() === $this) {
                $consultation->setVetId(null);
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

}
