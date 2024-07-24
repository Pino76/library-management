<?php

namespace App\Http\Controllers;

use App\DTO\BookDTO;
use App\Http\Requests\Book\BookRequest;
use App\Http\Requests\Book\SearchBookRequest;
use App\Interfaces\Service\IBookService;
use App\Interfaces\Service\IGenreService;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{

    private IBookService $bookService;
    private IGenreService $genreService;


    public function __construct(IBookService $bookService, IGenreService $genreService)
    {
        $this->bookService = $bookService;
        $this->genreService = $genreService;

    }

    public function index()
    {
        $books = $this->bookService->getAllBooks();
        $genres = $this->genreService->getAllGenre();

        return view('book/index', [
            "books" => $books,
            "genres" => $genres
        ]);
    }

    public function create()
    {
        $genres = $this->genreService->getAllGenre();
        return view('book/create', [
            "genres" => $genres
        ]);
    }


    public function store(BookRequest $request)
    {
        $bookDTO = new BookDTO(
            null,
            $request->title ,
            $request->isbn ,
            $request->author ,
            $request->genre_id ,
            $request->quantity ,
            $request->reserve ,
            $request->year
        );

        $this->bookService->saveBook($bookDTO);
    }

    public function show(Book $book)
    {
        #non utilizzato
        return false;
    }

    public function viewSearch()
    {
        $genres = $this->genreService->getAllGenre();
        return view('book/search',[
            "genres" => $genres,
            "books" => "",
            "bCount" => ""
        ]);
    }
    public function search(SearchBookRequest $request)
    {
        $books = $this->bookService->searchBook($request);
        $genres = $this->genreService->getAllGenre();
        return view('book/search', [
            "books" => $books,
            "genres" => $genres,
            "bCount" => $books->count()
        ]);
    }

    public function edit(Book $book)
    {
        $genres = $this->genreService->getAllGenre();
        return view('book.edit', [
            "book" => $book,
            "genres" => $genres
        ]);
    }

    public function update(BookRequest $request, Book $book)
    {
        $bookDTO = new BookDTO(
            $book->id,
            $request->title ,
            $request->isbn ,
            $request->author ,
            $request->genre_id ,
            $request->quantity ,
            $book->reserve,
            $request->year
        );
        $this->bookService->saveBook($bookDTO, $book);
    }

    public function destroy(Book $book)
    {
        $this->bookService->deleteBook($book);
    }

    public function reserve(Book $book)
    {
        $bookDTO = new BookDTO(
            $book->id,
            $book->title ,
            $book->isbn ,
            $book->author ,
            $book->genre_id ,
            $book->quantity ,
            $book->reserve ,
            $book->year
        );
        $this->bookService->reserveBook($bookDTO, Auth::id());
    }

}
