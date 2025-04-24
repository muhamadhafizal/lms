<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request){
        $books = Book::get();
        return view('member.book.index', compact('request', 'books'));
    }

    public function borrow(Request $request){
        
    }
}
