<?php

namespace App\Entity\Recipe;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Recipe\Step as Step;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Product\Product as Product;




#[ORM\Entity]
#[ORM\Table(name: "recipe")]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "recipe_id", type: "integer")]
    private int $id;


    #[ORM\Column(name: "recipe_name", type: "string", length: 50)]
    private string $recipeName;

    
    #[ORM\Column(name: "recipe_time_cooking", type: "float", length: 5)]
    private float $recipeTimeCooking;

    #[ORM\Column(name:"recipe_img",type: "string", nullable: false)]
    private string $imgRecipe;


    #[ORM\Column(name: "recipe_rate", type: "integer", length: 15)]
    private int $recipeRate;


    #[ORM\Column(name: "recipe_level", type: "string")]
    private string $recipeLevel;

    #[ORM\JoinTable(name: "recipe_step")]
    #[ORM\JoinColumn(name: "recipe_id", referencedColumnName: "recipe_id")]
    #[ORM\InverseJoinColumn(name:"step_id", referencedColumnName: "step_id")]
    #[ORM\ManyToMany(targetEntity: Step::class, fetch: "LAZY")]
    private ArrayCollection|Step $step;


    #[ORM\JoinTable(name: "recipe_product")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    #[ORM\InverseJoinColumn(name:"recipe_id", referencedColumnName: "recipe_id")]
    #[ORM\ManyToMany(targetEntity: Product::class, fetch: "LAZY")]
    private ArrayCollection|Product $recipeProduct;


    #[ORM\ManyToOne(targetEntity: Recipe_Type::class, fetch: "LAZY")]
    #[ORM\JoinColumn(name: "recipe_type_id", referencedColumnName: "recipe_type_id")]
    private Recipe_type $recipeType;

    #[ORM\Column(name: "recipe_updated_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $updatedAt;

    #[ORM\Column(name: "recipe_created_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $createdAt;



    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getRecipeName(): ?string
    {
        return $this->recipeName;
    }


    public function setName(string $pName): self
    {
        $this->recipeName = $pName;
        return $this;
    }


    public function getRecipeTime(): ?float
    {
        return $this->recipeTimeCooking;
    }


    public function setRecipeTime(float $pTime): self
    {
        $this->recipeTimeCooking = $pTime;
        return $this;
    }

    public function getImgRecipe(): ?string
    {
        return $this->imgRecipe;
    }
    public function setImgRecipe(string $pImgRecipe): self
    {
        $this->imgRecipe = $pImgRecipe;
        return $this;
    }

    public function getRecipeRate(): ?int
    {
        return $this->recipeRate;
    }


    public function setRecipeRate(int $pRate): self
    {
        $this->recipeRate = $pRate;
        return $this;
    }

    public function getRecipeLevel(): ?string
    {
        return $this->recipeLevel;
    }

    public function setRecipeLevel(string $pLevel): self
    {
        $this->recipeLevel = $pLevel;
        return $this;
    }

    public function getStep(): ArrayCollection|Step
    {
        return $this->step;
    }

    public function setStep(ArrayCollection|Step $pStep): self
    {
        $this->step = $pStep;
        return $this;
    }


    public function getRecipeProduct(): ArrayCollection|Product
    {
        return $this->recipeProduct;
    }

    public function setRecipeProduct(ArrayCollection|Product $pProduct): self
    {
        $this->recipeProduct = $pProduct;
        return $this;
    }


    public function getRecipeType(): ?Recipe_type
    {
        return $this->recipeType;
    }

    public function setRecipeType(?Recipe_type $pType): self
    {
        $this->recipeType = $pType;
        return $this;
    }

    public function getCreatedAt():?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTimeInterface $pCreatedAt): self
    {
        $this->createdAt = $pCreatedAt;
        return $this;
    }
    public function getUpdatedAt():?\DateTimeInterface
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(\DateTimeInterface $pUpdatedAt): self
    {
        $this->updatedAt = $pUpdatedAt;
        return $this;
    }
}















