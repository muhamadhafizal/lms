<?php

namespace App\Http\Controllers\Member;

use App\Enums\BookStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request){
        $books = Book::where('status', BookStatus::AVAILABLE->value)->get();
        $status = BookStatus::cases();
        return view('member.book.index', compact('request', 'books','status'));
    }

    public function store(BookRequest $request)
    {
        $title = $request->input('title');
        $book = Book::create([
            'title' => $title,
            'author' => $request->input('author'),
            'isbn' => $request->input('isbn'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('member.book.index', $book->id)->with('successMessage', "$title successfully Added.");
    }
}
