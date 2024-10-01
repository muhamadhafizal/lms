<?php

namespace App\Http\Requests\General\Setups\SupervisorFeedback;

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
                'unique:supervisor_feedback_setups,code,NULL,id,company_id,' . $this->company
            ]
        ];
    }
}
