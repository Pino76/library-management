<?php

namespace App\Interfaces\Service;

interface IUserService
{
    public function getAllBooksFromUser($userId);

    public function findBooksListFromEmail($email);

}
