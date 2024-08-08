<?php

namespace App\Services;

use App\DTO\BookDTO;
use App\Enum\BookUtility;
use App\Interfaces\Repository\IUserRepository;
use App\Interfaces\Service\IBookService;
use App\Interfaces\Repository\IBookRepository;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Carbon\Carbon;


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
        if ($bookDTO->getAvailable() == null) {
            $bookDTO->setAvailable($bookDTO->getQuantity());
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
            $request->title,
            null,
            $request->author,
            $request->genre_id,
            null,
            null,
            null
        );

        if ($bookDTO->getTitle() != null) {
            $bookDTO->setTitle($this->addLikeToWord($request->title));
        }

        if ($bookDTO->getAuthor() != null) {
            $bookDTO->setAuthor($this->addLikeToWord($request->author));
        }


        return $this->bookRepository->search($bookDTO);
    }


    /**
     * @param string $words
     * @return string
     */
    private function addLikeToWord(string $words): string
    {
        return '%' . str_replace(' ', '%', $words) . '%';
    }

    public function reserveBook(BookDTO $book, $user_id)
    {
        $checkBook = $this->userRepository->userHasBook($book->getId(), $user_id);
        if ($checkBook) {
            Log::alert("[" . __CLASS__ . "][" . __METHOD__ . "]" .
                " user_id: " . $user_id . " book_id: " . $book->getId() . " quantity: " . $book->getQuantity() . " available: " . $book->getAvailable());
            throw new BadRequestException("Qualcosa è andato storto!!!");
        }

        if ($book->getQuantity() > 0 && $book->getAvailable() > 0) {
            $book->setAvailable($book->getAvailable() - 1);
            return $this->bookRepository->save($book, new Book());
        } else {
            Log::alert("[" . __CLASS__ . "][" . __METHOD__ . "]" .
                " user_id: " . $user_id . " book_id: " . $book->getId() . " quantity: " . $book->getQuantity() . " available: " . $book->getAvailable());
            throw new BadRequestException("Qualcosa è andato storto!!!");
        }
    }

    public function stateBook(array $request)
    {
        $data = json_decode($request['pivot'], true);
        $status = $request["status"];

        $expireDate = Carbon::parse($data["expire_date"])->format('Y-m-d');
        $expireDateParse = Carbon::parse($expireDate);

        $validate = $this->checkDate($data["$status"], $expireDateParse, $status);
        if ($validate) {
            return $this->bookRepository->savePivot($request);
        } else {
            dd("Da gestire, validare le date di borrowed_date e returned_date con la data corrente e incrementare di 1 il libro e penalizzare utente");
        }

    }


    ###La data inserita deve essere maggiore della data di scadenza
    private function checkDate($statusDate, $expireDate, $statusName): bool
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentDateParse = Carbon::parse($currentDate);
        if ($statusDate === null) {
            if (BookUtility::BORROWED == $statusName && ($expireDate->isAfter($currentDateParse))) {
                return true;
            }
            if (BookUtility::RETURNED == $statusName && ($expireDate->isSameDay($currentDateParse) || $currentDateParse->isBefore($expireDate))) {
                return true;
            }
        }
        return false;
    }

}
