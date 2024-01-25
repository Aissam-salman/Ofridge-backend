<?php

// src/Service/UserService.php

namespace App\Service\User;

use App\Entity\User\User;
use App\Repository\User\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    private $userRepository;
    private $entityManager;
    private $passwordHasher;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function upgradeUserPassword(User $user, string $newPassword): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $user->getPassword()
        );
        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function createUser(array $userData): User
    {
        $user = new User();
        $user->setEmail($userData['email']);
        $user->setFirstName($userData['firstName']);
        $user->setLastName($userData['lastName']);
        $user->setBirthday($userData['birthday']);
        
        // Encodez le mot de passe avant de le définir
        $encodedPassword = $this->passwordHasher->hashPassword($user, $userData['password']);
        $user->setPassword($encodedPassword);

        $user->setImg($userData['img']);

        $this->userRepository->save($user);

        return $user;
    }

    public function deleteUser(User $user): void
    {
        // Supprimez l'utilisateur en utilisant le repository
        $this->userRepository->deleteUser($user);
    }


    

    // Ajoutez d'autres méthodes spécifiques ici en fonction de vos besoins
}
