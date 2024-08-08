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
        $hasBook = $user->books()->where('book_id', $bookId)->whereNull('returned_date')->exists();
        return $hasBook;
    }


    public function getAllBooksFromUser($userId)
    {
        $user = User::find($userId);
        $books = $user->books()->get();
        return $books;
    }

    public function findBooksListFromEmail($email)
    {
        $user = User::query()->where('email', $email)->first();
        $books = $user->books()->get();
        return $books;
    }


}
