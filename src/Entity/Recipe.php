<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var Collection<int, IngredientList>
     */
    #[ORM\OneToMany(targetEntity: IngredientList::class, mappedBy: 'recipe')]
    private Collection $ingredientLists;

    /**
     * @var Collection<int, InstructionList>
     */
    #[ORM\OneToMany(targetEntity: InstructionList::class, mappedBy: 'recipe')]
    private Collection $instructionLists;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;

    #[ORM\Column]
    private ?int $servings = null;

    public function __construct()
    {
        $this->ingredientLists = new ArrayCollection();
        $this->instructionLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, IngredientList>
     */
    public function getIngredientLists(): Collection
    {
        return $this->ingredientLists;
    }

    public function addIngredientList(IngredientList $ingredientList): static
    {
        if (!$this->ingredientLists->contains($ingredientList)) {
            $this->ingredientLists->add($ingredientList);
            $ingredientList->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredientList(IngredientList $ingredientList): static
    {
        if ($this->ingredientLists->removeElement($ingredientList)) {
            // set the owning side to null (unless already changed)
            if ($ingredientList->getRecipe() === $this) {
                $ingredientList->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InstructionList>
     */
    public function getInstructionLists(): Collection
    {
        return $this->instructionLists;
    }

    public function addInstructionList(InstructionList $instructionList): static
    {
        if (!$this->instructionLists->contains($instructionList)) {
            $this->instructionLists->add($instructionList);
            $instructionList->setRecipe($this);
        }

        return $this;
    }

    public function removeInstructionList(InstructionList $instructionList): static
    {
        if ($this->instructionLists->removeElement($instructionList)) {
            // set the owning side to null (unless already changed)
            if ($instructionList->getRecipe() === $this) {
                $instructionList->setRecipe(null);
            }
        }

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getServings(): ?int
    {
        return $this->servings;
    }

    public function setServings(int $servings): static
    {
        $this->servings = $servings;

        return $this;
    }
}
