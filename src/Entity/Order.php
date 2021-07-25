<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\{ApiResource, ApiFilter};
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\{SearchFilter, OrderFilter, RangeFilter, BooleanFilter, DateFilter};
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**

 * @ApiResource(normalizationContext= {"groups" = {"read"}})
 * @ApiFilter(DateFilter::class, properties={"date": DateFilter::INCLUDE_NULL_BEFORE_AND_AFTER})
 * @ApiFilter(OrderFilter::class, properties={"id"="desc", "date"="desc"})
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
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
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @Groups("read")
     * @ORM\Column(type="float")
     */
    private $sum;

    /**
     * @Groups("read")
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="ordres")
     */
    private $membre;

    /**
     * @Groups("read")
     * @ORM\OneToMany(targetEntity=OrderDetails::class, mappedBy="ordr")
     */
    private $details;

    /**
     * @Groups("read")
     * @ORM\Column(type="string", length=255)
     */
    private $curtomerId;

    public function __construct()
    {
        $this->details = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSum(): ?float
    {
        return $this->sum;
    }

    public function setSum(float $sum): self
    {
        $this->sum = $sum;

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

    /**
     * @Groups("read")
     * @return Collection|OrderDetails[]
     */

    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(OrderDetails $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
            $detail->setOrdr($this);
        }

        return $this;
    }

    public function removeDetail(OrderDetails $detail): self
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getOrdr() === $this) {
                $detail->setOrdr(null);
            }
        }

        return $this;
    }

    public function getCurtomerId(): ?string
    {
        return $this->curtomerId;
    }

    public function setCurtomerId(string $curtomerId): self
    {
        $this->curtomerId = $curtomerId;

        return $this;
    }
}
