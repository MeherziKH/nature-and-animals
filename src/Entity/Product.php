<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Cantiga\Metamodel\Exception\DiskAssetException;
use LogicException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * @ApiResource(normalizationContext= {"groups" = {"read"}})
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 *
 */
class Product
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
    private $libelle;

    /**
     * @Groups("read")
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Groups("read")
     * @ORM\Column(type="integer")
     */
    private $quantity;


    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     */
    private $category;

    /**
     * @Groups("read")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $local;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetails::class, mappedBy="product")
     */
    private $OrderDetails;

    public function __construct()
    {
        $this->OrderDetails = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getLocal(): ?int
    {
        return $this->local;
    }

    public function setLocal(?int $local): self
    {
        $this->local = $local;

        return $this;
    }

    /**
     * @return Collection|OrderDetails[]
     */
    public function getOrderDetails(): Collection
    {
        return $this->OrderDetails;
    }

    public function addOrderDetail(OrderDetails $orderDetail): self
    {
        if (!$this->OrderDetails->contains($orderDetail)) {
            $this->OrderDetails[] = $orderDetail;
            $orderDetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetails $orderDetail): self
    {
        if ($this->OrderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getProduct() === $this) {
                $orderDetail->setProduct(null);
            }
        }

        return $this;
    }



}
