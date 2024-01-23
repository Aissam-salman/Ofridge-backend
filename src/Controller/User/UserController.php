<?php
// src/Controller/UserController.php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $userRepository;
    private $userService;

    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     * @Route("/user/{id}/upgrade-password", name="user_upgrade_password", methods={"POST"})
     */
    public function upgradePassword(User $user): Response
    {
        // Vous pouvez ajouter ici la logique pour récupérer le nouveau mot de passe
        $newPassword = 'nouveau_mot_de_passe';

        // Mettez à jour le mot de passe de l'utilisateur
        $this->userService->upgradeUserPassword($user, $newPassword);

        return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
    }

    /**
     * @Route("/user/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }
}
