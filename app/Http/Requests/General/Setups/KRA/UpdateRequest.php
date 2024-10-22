<?php

namespace App\Http\Requests\General\Setups\KRA;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'header' => 'required|in:3,5',
            'name' => ['required',
                       'unique:k_r_a_header_setups,name,' . $this->kra->id . ',id,company_id,' . $this->company
            ],
            'no' => 'required|array',
            'no.*' => 'required|numeric',  // Validates each item in the `no` array
            'legend' => 'required|array',
            'legend.*' => 'required|string',  // Validates each item in the `legend` array
            'description' => 'required|array',
            'description.*' => 'required|string',  // Validates each item in the `description` array
        ];
    }
}
