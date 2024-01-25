<?php

namespace App\Entity\Recipe;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'recipe_type')]
class Recipe_Type {


    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "recipe_type_id", type: "integer")]
    private int $id;


    #[ORM\Column(name: "recipe_type_name", type: "string", length: 50)]
    private string $recipeTypeName;


    
    #[ORM\Column(name: "recipe_type_created_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $createdAt;
    #[ORM\Column(name: "recipe_type_updated_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $updatedAt;




    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getRecipeName(): ?string
    {
        return $this->recipeTypeName;
    }


    public function setName(string $pName): self
    {
        $this->recipeTypeName = $pName;
        return $this;
    }

    public function getCreatedAt():?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
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

