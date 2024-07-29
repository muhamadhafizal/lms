<?php

namespace App\Http\Requests\Superadmin\Client;

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
            'name' => "required|unique:clients,name,{$this->client->id}",
            'registration_date' => 'required',
            'invoice_date' => 'required',
            'next_renewal_date' => 'required',
            'contact' => 'required|exists:clients,contact',
            'email' => "required|email|unique:clients,email,{$this->client->id}",
            'contact_person' => 'required',
            'contact_tel' => 'required',
            'contact_email' => "required|email|unique:clients,contact_email,{$this->client->id}",
            'logo_file_name' => 'nullable|mimes:jpeg,jpg,png,svg:max:1000',
            'is_active' => 'required',
            'is_subscribed' => 'required',
        ];
    }
}