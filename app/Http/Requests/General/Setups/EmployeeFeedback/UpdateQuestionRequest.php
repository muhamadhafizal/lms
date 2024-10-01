<?php

namespace App\Http\Requests\General\Setups\EmployeeFeedback;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
            'employee_feedback_id' => 'required',
            'question' => [
                'required',
                'unique:employee_feedback_questions,question,'. $this->employeeFeedbackQuestion->id . ',id,efs_id,' . $this->employee_feedback_id
            ]
        ];
    }
}
