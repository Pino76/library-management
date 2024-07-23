<?php

namespace App\Repository;

use App\DTO\BookDTO;
use App\Interfaces\Repository\IBookRepository;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

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
        $bookArray = $bookDTO->toArray();
        return Book::query()->updateOrCreate(["id" => $bookDTO->getId()], $bookArray);
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
        $books = Book::query()->when(($bookDTO->getTitle() != ""), function ($query) use ($bookDTO) {
            return $query->where("title", "like", $bookDTO->getTitle());
        })->when(($bookDTO->getAuthor() != ""), function ($query) use ($bookDTO) {
            return $query->where("author", "like", $bookDTO->getAuthor());
        })->when(($bookDTO->getGenreId() != 0), function ($query) use ($bookDTO) {
            return $query->where("genre_id", "like", $bookDTO->getGenreId());
        });

        return $books->get();
    }


}
