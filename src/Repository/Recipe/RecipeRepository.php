<?php

namespace App\Repository\Recipe;



use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Recipe\Recipe;


class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }


    public function getAllRecipes() : array
    {
        
        return $this->findAll();
    }

    
    public function getRecipeById($recipeId) :array
    {
        return $this->createQueryBuilder('recipeEntity')
            ->where('recipeEntity.id = :recipeId')
            ->setParameter('recipeId', $recipeId)
            ->getQuery()
            ->getOneOrNullResult();
    }


}