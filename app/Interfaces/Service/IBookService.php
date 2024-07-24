<?php

namespace App\Interfaces\Service;

use App\DTO\BookDTO;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
interface IBookService
{
    public function getAllBooks(): Collection;
    public function saveBook(BookDTO $bookDTO): Book;
    public function deleteBook(Book $book);
    public function searchBook(Request $request);
    public function reserveBook(BookDTO $book, $user_id);
}
