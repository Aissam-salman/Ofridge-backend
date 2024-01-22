<?php

namespace App\DTO\Product;
use Symfony\Component\Validator\Constraints as Assert;
class ProductDto {
    // TODO: add validation
    public ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public ?string $name = null;
    public ?string $allergens = null;
    public ?string $brand = null;
    public ?string $genericName = null;
    public ?string $imgFront = null;
    public ?string $packaging = null;
    public ?float $quantity = null;
    public ?string $nutriscore = null;
    public ?string $category = null;
    public ?string $countries = null;
    public ?string $keywords = null;
    public ?string $nutriments = null;
    public ?string $composition = null;
    public ?string $updatedAt = null;
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
    public function getAllergens(): ?string
    {
        return $this->allergens;
    }
    public function setAllergens(?string $allergens): void
    {
        $this->allergens = $allergens;
    }
    public function getBrand(): ?string
    {
        return $this->brand;
    }
    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }
    public function getGenericName(): ?string
    {
        return $this->genericName;
    }
    public function setGenericName(?string $genericName): void
    {
        $this->genericName = $genericName;
    }
    public function getImgFront(): ?string
    {
        return $this->imgFront;
    }
    public function setImgFront(?string $imgFront): void
    {
        $this->imgFront = $imgFront;
    }
    public function getPackaging(): ?string
    {
        return $this->packaging;
    }
    public function setPackaging(?string $packaging): void
    {
        $this->packaging = $packaging;
    }
    public function getQuantity(): ?float
    {
        return $this->quantity;
    }
    public function setQuantity(?float $quantity): void
    {
        $this->quantity = $quantity;
    }
    public function getNutriscore(): ?string
    {
        return $this->nutriscore;
    }
    public function setNutriscore(?string $nutriscore): void
    {
        $this->nutriscore = $nutriscore;
    }
    public function getCategory(): ?string
    {
        return $this->category;
    }
    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }
    public function getCountries(): ?string
    {
        return $this->countries;
    }
    public function setCountries(?string $countries): void
    {
        $this->countries = $countries;
    }
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }
    public function setKeywords(?string $keywords): void
    {
        $this->keywords = $keywords;
    }
    public function getNutriments(): ?string
    {
        return $this->nutriments;
    }
    public function setNutriments(?string $nutriments): void
    {
        $this->nutriments = $nutriments;
    }
    public function getComposition(): ?string
    {
        return $this->composition;
    }
    public function setComposition(?string $composition): void
    {
        $this->composition = $composition;
    }
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}