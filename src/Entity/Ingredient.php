<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ingredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column]
    private ?float $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'ingredients')]
    #[ORM\JoinColumn(nullable: true)]
    private ?MeasuringUnit $measuringUnit = null;

    #[ORM\ManyToOne(inversedBy: 'ingredients')]
    private ?IngredientList $ingredientList = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getMeasuringUnit(): ?MeasuringUnit
    {
        return $this->measuringUnit;
    }

    public function setMeasuringUnit(?MeasuringUnit $measuringUnit): static
    {
        $this->measuringUnit = $measuringUnit;

        return $this;
    }

    public function getIngredientList(): ?IngredientList
    {
        return $this->ingredientList;
    }

    public function setIngredientList(?IngredientList $ingredientList): static
    {
        $this->ingredientList = $ingredientList;

        return $this;
    }
}
