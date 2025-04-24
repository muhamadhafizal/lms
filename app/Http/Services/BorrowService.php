<?php

namespace App\Http\Services;

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
}
