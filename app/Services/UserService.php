<?php

namespace App\Services;

use App\Interfaces\Repository\IUserRepository;
use App\Interfaces\Service\IUserService;

class UserService implements IUserService
{
    private IUserRepository $userRepository;
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getAllBooksFromUser($userId)
    {
      return  $this->userRepository->getAllBooksFromUser($userId);
    }

    public function findBooksListFromEmail($email)
    {
        return$this->userRepository->findBooksListFromEmail($email);
    }
}
