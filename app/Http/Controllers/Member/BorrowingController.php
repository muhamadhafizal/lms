<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\BorrowBookRequest;
use App\Http\Services\BorrowService;
use Illuminate\Http\Request;
use App\Models\Loan;


class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $loans = BorrowService::getIndex($request);

        return view('member.borrowing.index', compact('request','loans'));
    }

    public function borrow(BorrowBookRequest $request)
    {
        $loansBorrow = BorrowService::borrow($request);

        return to_route('member.borrowing.index')->with('successMessage', 'Successfully borrowing book');
      
    }

    public function return(Loan $loan, Request $request)
    {
        $return = BorrowService::returnBook($loan, $request);

        return to_route('member.borrowing.index')->with('successMessage', 'Successfully returning book');

    }
}
