<?php

namespace App\Http\Services;

use App\Models\Book;
use App\Models\Loan;
use Exception;
use Illuminate\Support\Facades\Hash;

class BorrowService
{

    public static function getIndex($request)
    {
        $loans = Loan::query()
            ->with('book')
            ->where('member_id', auth()->user()->id)
            ->paginate(20)
            ->withQueryString();

        return $loans;
    }

    public static function borrow($request)
    {
        $loan = Loan::create([
            'member_id' => auth()->user()->id,
            'book_id' => $request->book_id,
            'borrowed_at' => now(),
            'due_at' => now()->addDays(14),
        ]);

        $book = $loan->book;
        $book->update(['status' => 'BORROWED']);

        return $loan;
    }
}
