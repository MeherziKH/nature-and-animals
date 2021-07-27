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
 * @ApiResource(
 * attributes={"order"={"buyedd": "DESC"}},
 * normalizationContext= {"groups" = {"read"}},
 * collectionOperations={
 *      "get",
 *      "post" :{
 *      "input_formats" : {
 *             "multipart" : {"multipart/form-data"}
 *          }

 * },
 * }
 * )
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
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Groups("write")
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="image")
     * @var File
     */
    private  $imageFile ;


    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $quantity;


    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     */
    private $category;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $local;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetails::class, mappedBy="product")
     */
    private $OrderDetails;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $liked;


    private $targetDirectory = "media/products/";

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $buyed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $buyedd;

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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
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

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
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

    public function getLocal(): ?string
    {
        return $this->local;
    }

    public function setLocal(?string $local): self
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

    public function getLiked(): ?string
    {
        return $this->liked;
    }

    public function setLiked(?string $liked): self
    {
        $this->liked = $liked;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        $hashedName = sha1($image->getBasename() . filemtime($image->getPath()));
        $extension = strtolower($image->getClientOriginalExtension());
        $finalName = $hashedName . '.' . $extension;
        while (file_exists($this->targetDirectory . DIRECTORY_SEPARATOR . $this->hashToLocation($finalName))) {
            $hashedName .= '1';
            $finalName = $hashedName . '.' . $extension;
        }
        $hashed = $this->hashToLocation($finalName);
        $directory = $this->targetDirectory;
        if (!is_dir($directory)) {
            $ret = mkdir($directory, 0777, true);
            if (!$ret) {
                throw new DiskAssetException('Cannot create a directory for uploading the files!');
            }
        }
        $image->move($directory, $hashed);
        $this->image = $directory .DIRECTORY_SEPARATOR. $finalName;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    private function hashToLocation($name)
    {
        if (strlen($name) < 40) {
            throw new LogicException('This is not a hash: ' . $name);
        }
        $firstLevel = $name[0];
        $secondLevel = $firstLevel . $name[1];
        return $firstLevel . DIRECTORY_SEPARATOR . $secondLevel . DIRECTORY_SEPARATOR . $name;
    }

    public function getBuyed(): ?string
    {
        return $this->buyed;
    }

    public function setBuyed(?string $buyed): self
    {
        $this->buyed = $buyed;
        $this->buyedd = $buyed;
        return $this;
    }

    public function getBuyedd(): ?int
    {
        return $this->buyedd;
    }

    public function setBuyedd(?int $buyedd): self
    {
        $this->buyedd = $buyedd;

        return $this;
    }

}
