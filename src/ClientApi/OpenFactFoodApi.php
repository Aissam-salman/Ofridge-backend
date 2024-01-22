<?php

namespace App\ClientApi;

use Symfony\Contracts\HttpClient\HttpClientInterface as HttpClientInterface;
use Symfony\Component\Validator\Constraints as Assert;

class OpenFactFoodApi
{
    private static ?OpenFactFoodApi $instance = null;
    private HttpClientInterface $client;

    const PATTERN_ONLY_WORDS= "/[A-Za-z]+/i";
    const PATTERN_ONLY_INTEGER= "/[0-9]+/i";

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    public static function getInstance(HttpClientInterface $client): OpenFactFoodApi
    {
        if (self::$instance === null) {
            self::$instance = new self($client);
        }
        return self::$instance;
    }

    public function getByKeyword(string $keyword): array
    {
        dump($keyword);
        if (!preg_match(self::PATTERN_ONLY_WORDS, $keyword)) {
            throw new \Exception('Invalid keyword');
        } else {
            $url = "https://world.openfoodfacts.net/api/v2/search?_keywords=$keyword&lc=fr&fields=product_name,allergens_imported,brands,generic_name,selected_images,packaging_text,quantity,nutriscore_2023_tags,_keywords,categories_tags,countries,nutriments,ingredients_text,_id&page_size=5";
            /**
             * Mock data example:
             * /src/clientApi/examplesResult.json
             */
            $response = $this->client->request('GET', $url,
            [   'headers' => [
                    'Accept' => 'application/json',
                ]
            ]);
            $content = $this->handleApiResponse($response);
            return $content;
        }
    }

    public function getByBarcode(int $barcode): array
    {
        if (!preg_match(self::PATTERN_ONLY_INTEGER, $barcode)) {
            throw new \Exception('Invalid barcode');
        } else {
            $url = "https://world.openfoodfacts.net/api/v3/product/$barcode?lc=fr&fields=product_name,allergens_imported,brands,generic_name,selected_images,packaging_text,quantity,nutriscore_2023_tags,_keywords,categories_tags,countries,nutriments,ingredients_text%252_id";
            $response = $this->client->request('GET', $url,
            [   'headers' => [
                    'Accept' => 'application/json',
                ]
            ]);
            $content = $this->handleApiResponse($response);
            return $content;
        }
    }

    private function handleApiResponse($response): array
    {
        if ($response->getStatusCode() === 200) {
            $content = $response->toArray();
            return $content;
        } else {
            throw new \Exception('Erreur lors de la requête vers l\'API.');
        }
    }
}