<?php

namespace App\Entity\Recipe;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Recipe;
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


    #[ORM\Column(name: "recipe_rate", type: "integer", length: 15)]
    private int $recipeRate;


    #[ORM\Column(name: "recipe_level", type: "string")]
    private string $recipeLevel;


    #[ORM\JoinTable(name:"search_recipe")] // Création de la tab + son nom
    #[ORM\JoinColumn(name:"user_app_id", referencedColumnName:"recipe_id")]
    #[ORM\InverseJoinColumn(name:"recipe_id", referencedColumnName:"recipe_id")]
    #[ORM\ManyToMany(targetEntity:Recipe::class, fetch:"LAZY")] //
    
    private array[Recipe] $search_recipe; 






    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }


    public function getLastName(): ?string
    {
        return $this->lastName;
    }


    public function getBirthday(): ?DateType
    {
        return $this->birthday;
    }


    public function getPassword(): ?string
    {
        return $this->password;
    }


    public function getImg(): ?BlobType
    {
        return $this->img;
    }





    // Setters

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function setBirthday(DateType $birthday): self
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setImg(BlobType $img): self
    {
        $this->img = $img;
        return $this;
    }
}