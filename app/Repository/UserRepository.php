<?php

namespace App\Repository;

use App\DTO\BookDTO;
use App\Interfaces\Repository\IUserRepository;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements IUserRepository
{

    public function __construct()
    {

    }


    public function userHasBook($bookId, $userId):bool
    {
        $user = User::find($userId);
        $hasBook = $user->books()->where('book_id', $bookId)->exists();
        return $hasBook;
    }







}
