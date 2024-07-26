<?php

namespace App\Repository;

use App\DTO\BookDTO;
use App\Enum\UserRoles;
use App\Interfaces\Repository\IBookRepository;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BookRepository implements IBookRepository
{

    public function __construct()
    {

    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Book::all();
    }

    /**
     * @param BookDTO $bookDTO
     * @param Book $book
     * @return Book
     */
    public function save(BookDTO $bookDTO): Book
    {
        $userId = Auth::id();
        return DB::transaction(function() use ($bookDTO, $userId) {
            $bookArray = $bookDTO->toArray();
            $book = Book::updateOrCreate(['id' => $bookDTO->getId()], $bookArray);
            if($userId == UserRoles::USER){
                $book->users()->attach($userId);
            }
            return $book;
        }, 2);

    }

    /**
     * @param Book $book
     * @return bool
     */
    public function delete(Book $book): bool
    {
        return $book->delete();
    }

    /**
     * @param BookDTO $bookDTO
     * @return Collection
     */
    public function search(BookDTO $bookDTO): Collection
    {
        $userId = Auth::id();
        $books = Book::query()
            ->leftJoin('book_user', function ($join) use ($userId) {
                $join->on('books.id', '=', 'book_user.book_id')
                    ->where('book_user.user_id', '=', $userId);
            })
            ->select('books.*', DB::raw('IF(book_user.user_id IS NULL, 0, 1) as is_assigned'))
            ->when($bookDTO->getTitle() != "", function ($query) use ($bookDTO) {
                return $query->where("title", "like", $bookDTO->getTitle());
            })
            ->when($bookDTO->getAuthor() != "", function ($query) use ($bookDTO) {
                return $query->where("author", "like", $bookDTO->getAuthor());
            })
            ->when($bookDTO->getGenreId() != 0, function ($query) use ($bookDTO) {
                return $query->where("genre_id", $bookDTO->getGenreId());
            })
            ->get();

        return $books;
    }


}
