<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEmailRequest;
use App\Interfaces\Service\IUserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private IUserService $userService;
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAllBooksFromUser()
    {
        $userId = Auth::user()->id;
        $books = $this->userService->getAllBooksFromUser($userId);
        return view('user.user-books' ,["books" => $books]);
    }

    public function adminSearchUserBooks()
    {
        return view('user.admin-user-books', ["books" =>[]]);
    }

    public function adminUserBookList(UserEmailRequest $request)
    {
        $books = $this->userService->findBooksListFromEmail($request->email);
        return view('user.admin-user-books' ,["books" => $books]);
    }
}
