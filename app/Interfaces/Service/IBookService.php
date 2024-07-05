<?php

namespace app\Interfaces\Service;

interface IBookService
{

    public function getAllBooks(): Collection;
    public function saveBook(BookDTO $bookDTO): Book;
    public function deleteBook(Book $book);
    public function searchBook(Request $request);
    public function reserveBook(BookDTO $book);
}
