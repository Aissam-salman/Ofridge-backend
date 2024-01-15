<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product\Nutriment as Nutriment;
use App\Entity\Product\Product as Product;

#[ORM\Entity]
#[ORM\Table(name: "product_nutriment")]
class ProductNutriment {
    #[ORM\Id]
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: "nutriments")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    private Product $product;

    #[ORM\ManyToMany(targetEntity: Nutriment::class, inversedBy: "product")]
    #[ORM\JoinColumn(name: "nutriment_id", referencedColumnName: "nutriment_id")]
    private Nutriment $nutriment;

    #[ORM\Column(name: "product_nutriment_quantity", type: "float", nullable: false)]
    private float $quantity;

    public function getProduct():?Product
    {
        return $this->product;
    }
    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }
    public function getNutriment():?Nutriment
    {
        return $this->nutriment;
    }
    public function setNutriment(?Nutriment $nutriment): self
    {
        $this->nutriment = $nutriment;
        return $this;
    }

    public function getQuantity():?float
    {
        return $this->quantity;
    }
    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }
}