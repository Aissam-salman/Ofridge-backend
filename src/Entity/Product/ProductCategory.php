<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'product_category')]
class ProductCategory {
    #[ORM\Id]
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: "category")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    private $product;
    #[ORM\Id]
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: "product")]
    #[ORM\JoinColumn(name: "category_id", referencedColumnName: "category_id")]
    private $category;

    public function getProduct():?array
    {
        return $this->product;
    }
    public function setProduct(array $pProduct): self
    {
        $this->product = $pProduct;
        return $this;
    }
    public function getCategory():?array
    {
        return $this->category;
    }

    public function setCategory(array $pCategory): self
    {
        $this->category = $pCategory;
        return $this;
    }
}