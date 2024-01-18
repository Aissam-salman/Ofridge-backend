<?php

namespace App\Mapper\Product;

use App\DTO\Product\ProductDto;
use App\Entity\Product\Product;


class ProductMapper {
    public function mapProductDtoToProduct(ProductDto $productDto, Product $entity): Product
    {
        $entity->setId($productDto->getId());
        $entity->setName($productDto->getName());
        $entity->setAllergens($productDto->getAllergens());
        $entity->setBrand($productDto->getBrand());
        $entity->setGenericName($productDto->getGenericName());
        $entity->setImgFront($productDto->getImgFront());
        $entity->setPackaging($productDto->getPackaging());
        $entity->setQuantity($productDto->getQuantity());
        $entity->setNutriscore($productDto->getNutriscore());
        $entity->setCategory($productDto->getCategory());
        $entity->setCountries($productDto->getCountries() ? json_encode($productDto->getCountries()) : null);
        $entity->setKeywords($productDto->getKeywords());
        $entity->setNutriments($productDto->getNutriments());
        $entity->setComposition($productDto->getComposition());

        return $entity;
    }
}