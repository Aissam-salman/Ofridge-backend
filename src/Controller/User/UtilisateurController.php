<?php
// src/Controller/UserController.php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Repository\User\UserRepository;
use App\Service\User\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class UtilisateurController extends AbstractController
{

    private $userService;

    public function __construct(UserService $userService)
    {
      
        $this->userService = $userService;
    }

    /**
     * @Route("/user/{id}/upgrade-password", name="user_upgrade_password", methods={"POST"})
     */
    public function upgradePassword(User $user): JsonResponse
    {
        // Vous pouvez ajouter ici la logique pour récupérer le nouveau mot de passe
        $newPassword = 'nouveau_mot_de_passe';

        // Mettez à jour le mot de passe de l'utilisateur
        $this->userService->upgradeUserPassword($user, $newPassword);

        return $this->json(['message' => 'Mot de passe changé'], Response::HTTP_OK);
    }

    /**
     * @Route("/user/create", name="user_create", methods={"POST"})
     */
    public function createUser(Request $request): Response
    {
        // Récupérez les données du formulaire ou de la requête
        $userData = [
            'email' => $request->request->get('email'),
            'firstName' => $request->request->get('firstName'),
            'lastName' => $request->request->get('lastName'),
            'birthday' => $request->request->get('birthday'),
            'password' => $request->request->get('password'),
            'img' => $request->request->get('img'),
        ];

        // Créez un nouvel utilisateur en utilisant le service
        $user = $this->userService->createUser($userData);

        // Retournez une réponse JSON
        $userData = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'birthday' => $user->getBirthday(),
            'img' => $user->getImg(),
        ];

        return $this->json($userData, Response::HTTP_CREATED);
    }

    /**
     * @Route("/user/{id}/delete", name="user_delete", methods={"DELETE"})
     */
    public function deleteUser(User $user): Response
    {
        // Supprimez l'utilisateur en utilisant le service
        $this->userService->deleteUser($user);

        // Retournez une réponse JSON
        return $this->json(['message' => 'Utilisateur supprimé'], Response::HTTP_OK);
    }

    #[Route("/user/{id}", name:"user_show", methods:["GET"])]
    
    public function show(User $user): jsonResponse
    {
        return $this->json($user, Response::HTTP_OK);
    }
}
