<?php

namespace App\Interfaces\Repository;

interface IUserRepository
{
    public function userHasBook($bookId, $userId): bool;
}
