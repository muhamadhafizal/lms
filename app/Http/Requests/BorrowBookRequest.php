<?php

namespace App\Http\Requests;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Foundation\Http\FormRequest;

class BorrowBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_id' => 'required|exists:books,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            
            $bookId = $this->book_id;

            $currentLoan = Loan::where('member_id', auth()->user()->id)
                    ->whereNull('returned_at')
                    ->count();
            
            if($currentLoan > 6){
                $validator->errors()->add('You can only borrow up to 5 books.');
            }

            $availableBook = Book::where('id', $bookId)
                    ->where('status', 'AVAILABLE')
                    ->first();

            if(!$availableBook){
                $validator->errors()->add('The book is not available.');
            }

        });
    }
}
