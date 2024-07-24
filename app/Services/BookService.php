<?php

namespace App\Services;

use App\DTO\BookDTO;
use App\Interfaces\Repository\IUserRepository;
use App\Interfaces\Service\IBookService;
use App\Interfaces\Repository\IBookRepository;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


class BookService implements IBookService
{

    private IBookRepository $bookRepository;
    private IUserRepository $userRepository;


    public function __construct(IBookRepository $bookRepository, IUserRepository $userRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->userRepository = $userRepository;
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

    public function reserveBook(BookDTO $book , $user_id)
    {
        $checkBook = $this->userRepository->userHasBook($book->getId(), $user_id);
        if($checkBook){
            Log::alert("[".__CLASS__ ."][".__METHOD__."]".
                " user_id: " . $user_id . " book_id: ". $book->getId() . " quantity: " . $book->getQuantity() . " reserve: " . $book->getReserve() );
            throw new BadRequestException("Qualcosa è andato storto!!!");
        }

        if($book->getQuantity() > 0 && $book->getReserve() > 0){
            $book->setReserve($book->getReserve() - 1);
            return $this->bookRepository->save($book, new Book());
        }else{
            Log::alert("[".__CLASS__ ."][".__METHOD__."]".
                " user_id: " . $user_id . " book_id: ". $book->getId() . " quantity: " . $book->getQuantity() . " reserve: " . $book->getReserve() );
            throw new BadRequestException("Qualcosa è andato storto!!!");
        }
    }

}
