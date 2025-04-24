<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request){
        $books = Books::get();
        return view('member.book.index', compact('request', 'books'));
    }
}
