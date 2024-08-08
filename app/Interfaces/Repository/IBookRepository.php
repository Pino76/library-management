<?php

namespace App\Interfaces\Repository;

use App\DTO\BookDTO;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface IBookRepository
{
    public function getAll(): Collection;
    public function save(BookDTO $bookDTO): Book;
    public function delete(Book $book): bool;
    public function search(BookDTO $bookDTO): Collection;
    public function savePivot(array $request);
}
