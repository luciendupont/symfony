<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type:'string',length: 50)]
    #[Assert\notblank()]
    #[Assert\length(min:2,max:50)]
    private string $name ;

    #[ORM\Column(type:'float')]
    #[Assert\NotNull()]
    #[Assert\positive()]
    #[Assert\lessthan(200)]
    private float $price ;

    #[ORM\Column (type:'DateTime_Immutable')]
    #[Assert\NotNull()]
    private DateTimeImmutable $createdAt;

    /*
    * constructor
     */
    public function __construct()
    {
        $this->createdAt=new DateTimeImmutable();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
