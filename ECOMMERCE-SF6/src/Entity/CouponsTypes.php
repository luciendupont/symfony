<?php

namespace App\Entity;

use App\Repository\CouponsTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponsTypesRepository::class)]
class CouponsTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'coupons_type', targetEntity: Coupons::class)]
    private Collection $yes;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Coupouns>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Coupouns $ye): self
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->setCouponsType($this);
        }

        return $this;
    }

    public function removeYe(Coupouns $ye): self
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getCouponsType() === $this) {
                $ye->setCouponsType(null);
            }
        }

        return $this;
    }
}
