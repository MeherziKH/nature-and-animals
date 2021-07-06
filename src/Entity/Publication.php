<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;             
use App\Repository\PublicationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Cantiga\Metamodel\Exception\DiskAssetException;
use LogicException;
use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
 * @ApiResource(
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
 * @ORM\Entity(repositoryClass=PublicationRepository::class)
 * 
 */


class Publication
{
    /**
    *  @Groups("read")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @Groups({"read", "write"})
     * @ORM\OneToOne(targetEntity=Animal::class, cascade={"persist", "remove"})
     */
    private $id_animal;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @Groups({"read", "write"})
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="idPublication")
     */
    private $membre;

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
     * @Groups("write")
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="file")
     * @var File
     */
    private  $contentFile ;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @Groups("write")
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="publications")
     */
    private $type;

    /**
     * @Groups("read")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    private $targetDirectory = "media/publications/";
    private $targetDirectoryFile = "files/publications/";


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
        $this->updatedAt = new \DateTime('now');

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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
         // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
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

    public function setContentFile(File $file = null)
    {
        $this->contentFile = $file;
         // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
        $hashedName = sha1($file->getBasename() . filemtime($file->getPath()));
        $extension = strtolower($file->getClientOriginalExtension());
        $finalName = $hashedName . '.' . $extension;
        while (file_exists($this->targetDirectoryFile . DIRECTORY_SEPARATOR . $this->hashToLocation($finalName))) {
            $hashedName .= '1';
            $finalName = $hashedName . '.' . $extension;
        }
        $hashed = $this->hashToLocation($finalName);
        $directory = $this->targetDirectoryFile;
        if (!is_dir($directory)) {
            $ret = mkdir($directory, 0777, true);
            if (!$ret) {
                throw new DiskAssetException('Cannot create a directory for uploading the files!');
            }
        }
        $file->move($directory, $hashed);
        $this->file = $directory .DIRECTORY_SEPARATOR. $finalName;
    }

    public function getContentFile()
    {
        return $this->contentFile;
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
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
}
