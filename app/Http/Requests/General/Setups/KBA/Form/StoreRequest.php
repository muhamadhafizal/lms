<?php

namespace App\Http\Requests\General\Setups\KBA\Form;

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
            'code' => [
                'required',
                'unique:k_b_a_forms,code,NULL,id,company_id,' . $this->company
            ],
            'form_description' => 'required',
            'header' => 'required|in:3,5',
            'no' => 'required|array',
            'no.*' => 'required|numeric',  // Validates each item in the `no` array
            'legend' => 'required|array',
            'legend.*' => 'required|string',  // Validates each item in the `legend` array
            'description' => 'required|array',
            'description.*' => 'required|string',  // Validates each item in the `description` array
        ];
    }
}
