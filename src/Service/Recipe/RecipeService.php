<?php 

namespace App\Service\Recipe;


use App\Entity\Recipe\Recipe;
use App\Repository\Recipe\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;


class RecipeService
{

    private $entityManager;
    private $recipeRepository;

    public function __construct(EntityManagerInterface $entityManager, RecipeRepository $recipeRepository)
    {
        $this->entityManager = $entityManager;
        $this->recipeRepository = $recipeRepository;
    }



    public function getAllRecipes(): array
    {
        return $this->recipeRepository->getAllRecipes();
    }


}