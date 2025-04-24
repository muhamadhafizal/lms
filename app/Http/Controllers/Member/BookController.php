<?php

namespace App\Http\Controllers\Member;

use App\Enums\BookStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Services\BookService;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request, BookService $bookService){
        $books = $bookService->getIndex($request);
        $status = BookStatus::cases();
        return view('member.book.index', compact('request', 'books','status'));
    }

    public function store(BookRequest $request, BookService $bookService)
    {
        $title = $request->input('title');
        $book = $bookService->addBook($request);

        return redirect()->route('member.book.index', $book->id)->with('successMessage', "$title successfully Added.");
    }
}
