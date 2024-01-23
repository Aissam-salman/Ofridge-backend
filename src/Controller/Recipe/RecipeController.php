<?php


namespace App\Controller\Recipe;

use App\Service\Recipe\RecipeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    private $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    
      #[Route("/recipes", name: "get_all_recipes", methods: ["GET"])]
     
    
    public function getAllRecipes(): JsonResponse
    {
        $recipes = $this->recipeService->getAllRecipes();

        // Convertir les entités en tableau pour JSON
        $recipeData = [];
        foreach ($recipes as $recipe) {
            $recipeData[] = [
                'id' => $recipe->getId(),
                'name' => $recipe->getRecipeName(),
                'time_cooking' => $recipe->getRecipeTimeCooking(),
                'rate' => $recipe->getRecipeRate(),
                'level' => $recipe->getRecipeLevel(),
            ];
        }

        return new JsonResponse($recipes);
    }
}