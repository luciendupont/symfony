<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $reference = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Coupons $coupons = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?users $users = null;

    #[ORM\OneToMany(mappedBy: 'orders', targetEntity: OrdersDetails::class, orphanRemoval: true)]
    private Collection $yes;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCoupons(): ?Coupouns
    {
        return $this->coupons;
    }

    public function setCoupons(?Coupouns $coupons): self
    {
        $this->coupons = $coupons;

        return $this;
    }

    public function getUsers(): ?users
    {
        return $this->users;
    }

    public function setUsers(?users $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, OrdersDetails>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(OrdersDetails $ye): self
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->setOrders($this);
        }

        return $this;
    }

    public function removeYe(OrdersDetails $ye): self
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getOrders() === $this) {
                $ye->setOrders(null);
            }
        }

        return $this;
    }
}
