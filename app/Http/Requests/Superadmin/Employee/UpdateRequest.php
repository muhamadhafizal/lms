<?php

namespace App\Http\Requests\Superadmin\Employee;

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
            'user_name' => "required|unique:users,user_name,{$this->employee->id}",
            'user_email' => "required|email|unique:users,user_email,{$this->employee->id}",
            'client' => 'required|exists:clients,id',
            'company' => 'required|exists:companies,id',
            'role' => 'required|exists:roles,id',
        ];
    }
}
