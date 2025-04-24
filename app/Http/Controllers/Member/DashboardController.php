<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $availableBooks = Book::where('status', 'AVAILABLE')->count();
    $borrowedBooks = Book::where('status', 'BORROWED')->count();
    $currentBorrowedBooks = Book::where('status', 'BORROWED')->orderBy('updated_at', 'desc')->paginate(3);

    return view('member.dashboard.index', compact('availableBooks', 'borrowedBooks', 'currentBorrowedBooks'));
}

}
