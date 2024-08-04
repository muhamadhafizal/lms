<?php

namespace App\Http\Requests\Superadmin\Company;

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
            'client_id' => 'required|exists:clients,id',
            'name' => "required|unique:companies,name,{$this->company->id}",
            'former_name' => "required|unique:companies,former_name,{$this->company->id}",
            'roc_one' => "required|unique:companies,roc_one,{$this->company->id}",
            'roc_two' => "required|unique:companies,roc_two,{$this->company->id}",
            'contact' => "required|unique:companies,contact,{$this->company->id}",
            'email' => "required|email|unique:companies,email,{$this->company->id}",
            'registration_date' => 'required',
            'invoice_date' => 'required',
            'next_renewal_date' => 'required',
            'person_name' => 'required',
            'is_active' => 'required',
        ];
    }
}
