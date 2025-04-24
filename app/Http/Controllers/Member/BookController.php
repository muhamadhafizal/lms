<?php

namespace App\Http\Controllers\Member;

use App\Enums\BookStatus;
use App\Http\Controllers\Controller;
use App\Models\Books;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request){
        $books = Books::whereColumn('status', BookStatus::AVAILABLE->value)->get();
        $status = BookStatus::cases();
        return view('member.book.index', compact('request', 'books','status'));
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $book = Books::create([
            'title' => $title,
            'author' => $request->input('author'),
            'isbn' => $request->input('isbn'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('member.book.index', $book->id)->with('successMessage', "$title successfully Added.");
    }
}
