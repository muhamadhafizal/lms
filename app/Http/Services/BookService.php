<?php

namespace App\Http\Services;

use App\Enums\BookStatus;
use App\Models\Book;
use App\Models\Loan;

class BookService
{

    public static function getIndex($request)
    {
        $books = Book::where('status', BookStatus::AVAILABLE->value)->paginate(10);

        return $books;
    }
    
    public static function addBook($request)
    {
        $book = Book::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'isbn' => $request->input('isbn'),
            'status' => $request->input('status'),
        ]);

        return $book;
    }
}
