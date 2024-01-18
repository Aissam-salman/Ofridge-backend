<?php

namespace App\Repository\Product;

use App\Entity\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\ClientApi\OpenFactFoodapi;

class ProductRepository extends ServiceEntityRepository
{
    private OpenFactFoodapi $openFactFoodapi;
    public function __construct(ManagerRegistry $registry,OpenFactFoodapi $openFactFoodapi)
    {
        parent::__construct($registry, Product::class);
        $this->openFactFoodapi = $openFactFoodapi;
    }
    public function findProductsByProductName(string $productName): Product|array
    {
        if (!is_string($productName) || strlen(trim($productName)) == 0) {
            throw new \InvalidArgumentException("Product name must be a non-empty string.");
        }
        $entityManager = $this->getEntityManager();
        $products = $entityManager->find(Product::class, $productName);
        if ($products instanceof Product) {
            return $products;
        } else {
            throw new \InvalidArgumentException ("No products found with the provided product name.");
        }
    }
}

