<?php
namespace App\Service\Product;

use App\Repository\Product\ProductRepository;
use App\Entity\Product\Product;

class ProductService
{
    private ProductRepository $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function findProductsByProductName(string $productName): Product|array
    {
        $databaseResult = $this->productRepository->findProductsByProductName($productName);
        $apiResult = $this->productRepository->apiFindProductsByKeyword($productName);
        dump($databaseResult);
        return $this->getFirstNonEmptyResult([$databaseResult, $apiResult]);
    }
    public function findProductsByProductCode(int $productCode): Product|array
    {
        $databaseResult = $this->productRepository->findProductsByProductCode($productCode);
        $apiResult = $this->productRepository->apiFindProductsByBarcode($productCode);

        return $this->getFirstNonEmptyResult([$databaseResult, $apiResult]);
    }
    private function getFirstNonEmptyResult(array $results): Product|array
    {
        foreach ($results as $result) {
            if (!empty($result)) {
                return $result;
            }
        }
        throw new \RuntimeException("No results found in both database and API.");
    }
}
