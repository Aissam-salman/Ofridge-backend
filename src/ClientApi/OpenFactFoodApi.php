<?php

namespace App\ClientApi;

use Symfony\Contracts\HttpClient\HttpClientInterface as HttpClientInterface;

class OpenFoodFactsApi
{
    private static ?OpenFoodFactsApi $instance = null;
    private HttpClientInterface $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    public static function getInstance(HttpClientInterface $client): OpenFoodFactsApi
    {
        if (self::$instance === null) {
            self::$instance = new self($client);
        }
        return self::$instance;
    }

    public function getByKeyword(string $keyword): array
    {

        $url = "https://world.openfoodfacts.net/api/v2/search?_keywords=$keyword&lc=fr&fields=product_name,allergens_imported,brands,generic_name,selected_images,packaging_text,quantity,nutriscore_2023_tags,_keywords,categories_tags,countries,nutriments,ingredients_text,_id&page_size=5";

        /**
         * Mock data example:
         * /src/clientApi/examplesResult.json
         */

        $response = $this->client->request(
            'GET',
            $url
        );

        $content = $response->toArray();
        return $content;
    }

    public function getByBarcode(string $barcode): array
    {
        $url = "https://world.openfoodfacts.net/api/v3/product/$barcode?lc=fr&fields=product_name,allergens_imported,brands,generic_name,selected_images,packaging_text,quantity,nutriscore_2023_tags,_keywords,categories_tags,countries,nutriments,ingredients_text%252_id";

        $response = $this->client->request(
            'GET',
            $url
        );
        $content = $response->toArray();
        return $content;
    }
}