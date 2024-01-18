<?php

namespace App\Controller\Product;

use App\DTO\Product\ProductDto;
use App\Service\Product\ProductService;
use App\Mapper\Product\ProductMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductService $productService;
    private ProductMapper $productMapper;

    public function __construct(ProductService $productService, ProductMapper $productMapper)
    {
        $this->productService = $productService;
        $this->productMapper = $productMapper;
    }

    #[Route("/product/{productName}", name: "find_products_by_name", methods: ["GET"])]
    public function findProductByName(ProductDto $productDto): JsonResponse
    {
        try {
            $this->validateProductDto($productDto);
            $result = $this->productService->findProductsByProductName($productDto->name);
            return $this->json(['result' => $result]);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], 400);
        }
    }
    private function validateProductDto(ProductDto $productDto): void
    {
        if ($productDto->name === null && $productDto->id === null) {
            throw new \InvalidArgumentException("Product name or code is required.");
        }

        if ($productDto->name !== null && !is_string($productDto->name)) {
            throw new \InvalidArgumentException("Invalid product name format.");
        }

        if ($productDto->id !== null && !is_int($productDto->id)) {
            throw new \InvalidArgumentException("Invalid product code format.");
        }
    }

}