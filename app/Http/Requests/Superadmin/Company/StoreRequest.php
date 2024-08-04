<?php

namespace App\Http\Requests\Superadmin\Company;

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
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|unique:companies,name',
            'former_name' => 'required|unique:companies,former_name',
            'roc_one' => 'required|unique:companies,roc_one',
            'roc_two' => 'required|unique:companies,roc_two',
            'contact' => 'required|unique:companies,contact',
            'email' => 'required|email|unique:companies,email',
            'registration_date' => 'required',
            'invoice_date' => 'required',
            'next_renewal_date' => 'required',
            'person_name' => 'required',

        ];
    }
}
