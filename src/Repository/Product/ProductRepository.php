<?php
namespace App\Repository\Product;

use App\Entity\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\ClientApi\OpenFactFoodApi;
use Symfony\Component\HttpClient\HttpClient;

class ProductRepository extends ServiceEntityRepository
{
    private OpenFactFoodApi $openFactFoodApi;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
        $this->openFactFoodApi = OpenFactFoodApi::getInstance(HttpClient::create());
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
            throw new \InvalidArgumentException ("No products ici found with the provided product name.");
        }
    }
    public function findProductsByProductCode(int $productCode): Product|array
    {
        if(!is_int($productCode) || preg_match('/^[0-9]+$/', $productCode) === 0) {
            throw new \InvalidArgumentException("Product code must be an integer.");
        }
        $entityManager = $this->getEntityManager();
        $products = $entityManager->find(Product::class, $productCode);
        if ($products instanceof Product) {
            return $products;
        } else {
            throw new \InvalidArgumentException ("No products found with the provided product code.");
        }
    }
    public function apiFindProductsByKeyword(string $keyword): array
    {

        if (!is_string($keyword) || strlen(trim($keyword)) == 0) {
            throw new \InvalidArgumentException("Product name must be a non-empty string.");
        }
        return $this->openFactFoodApi->getByKeyword($keyword);
    }
    public function apiFindProductsByBarcode(int $barcode): array
    {
        if (!is_int($barcode) || preg_match('/^[0-9]+$/', $barcode) === 0) {
            throw new \InvalidArgumentException("Product code must be an integer.");
        }
        return $this->openFactFoodApi->getByBarcode($barcode);
    }

    public function creaeProductFromApiResponse(array $response): Product
    {
        $product = new Product();
        $product->setId($response['_id']);
        $product->setName($response['product_name']);
        $product->setAllergens($response['allergens_imported']);
        $product->setBrand($response['brands']);
        $product->setGenericName($response['generic_name']);
        $product->setImgFront($response['selected_images']['front']);
        $product->setPackaging($response['packaging_text']);
        $product->setQuantity($response['quantity']);
        $product->setNutriscore($response['nutriscore_2023_tags']);
        $product->setCategory($response['categories_tags']);
        $product->setCountries($response['countries']);
        $product->setKeywords($response['_keywords']);
        $product->setNutriments($response['nutriments']);
        $product->setComposition($response['ingredients_text']);

        return $product;
    }
}

