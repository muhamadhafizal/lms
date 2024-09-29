<?php

namespace App\Http\Requests\General\Setups\Batch;

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
                'regex:/^\d{4}(\/(0[1-9]|1[0-2]))?$/', // Allows either YYYY or YYYY/MM format
                'unique:batch_setups,code,NULL,id,company_id,' . $this->company
            ]
        ];
    }
}
