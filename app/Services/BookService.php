<?php

namespace App\Services;

use App\DTO\BookDTO;
use App\Interfaces\Service\IBookService;
use App\Interfaces\Repository\IBookRepository;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BookService implements IBookService
{

    private IBookRepository $bookRepository;


    public function __construct(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }


    /**
     * @return Collection
     */
    public function getAllBooks(): Collection
    {
        return $this->bookRepository->getAll();
    }


    /**
     * @param BookDTO $bookDTO
     * @param Book $book
     * @return Book
     */
    public function saveBook(BookDTO $bookDTO): Book
    {
        if($bookDTO->getReserve() == null){
            $bookDTO->setReserve($bookDTO->getQuantity());
        }
        return $this->bookRepository->save($bookDTO);
    }


    /**
     * @param Book $book
     * @return bool
     */
    public function deleteBook(Book $book): bool
    {
        return $this->bookRepository->delete($book);
    }


    /**
     * @param Request $request
     * @return Collection
     */
    public function searchBook(Request $request): Collection
    {
        $bookDTO = new BookDTO(
            null,
            $request->title ,
            null ,
            $request->author ,
            $request->genre_id ,
            null ,
            null,
            null
        );

        if($bookDTO->getTitle() != null){
            $bookDTO->setTitle($this->addLikeToWord($request->title));
        }

        if($bookDTO->getAuthor() != null){
            $bookDTO->setAuthor($this->addLikeToWord($request->author));
        }

        return $this->bookRepository->search($bookDTO);
    }


    /**
     * @param string $words
     * @return string
     */
    private function addLikeToWord(string $words):string
    {
        return '%' . str_replace(' ', '%', $words) . '%';
    }

    public function reserveBook(BookDTO $book)
    {
        // TODO: Controllo se user ha già prenotato il libro
        if($book->getQuantity() > 0 && $book->getReserve() > 0){
            Log::info("prenotazioni: " . $book->getReserve());
            $book->setReserve($book->getReserve() - 1);
            return $this->bookRepository->save($book, new Book());
        }else{
            return "";
        }

    }

}
