<?php

namespace App\Http\Requests\General\Appraisal\FormSetup;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'company' => 'required|exists:companies,id',
            'code' => 'required',
            'description' => 'required',
            'category' => 'required',
            'batch_setup_id' => 'required|exists:batch_setups,id',
            'review_start_date' => 'required|date',
            'review_end_date' => 'required|date',
            'rating_start_date' => 'required|date',
            'rating_end_date' => 'required|date',
        ];
    }
}
