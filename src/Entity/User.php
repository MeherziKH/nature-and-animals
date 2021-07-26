<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource(formats={"json"})
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

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
    private $tel;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity=Publication::class, mappedBy="membre")
     */
    private $idPublication;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="membre")
     */
    private $ordres;

    public function __construct()
    {
        $this->ordres = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel): void
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
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

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }
}
