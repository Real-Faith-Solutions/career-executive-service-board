<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationalAttainmentStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            
            'level' => ['required'],
            'school' => ['required','max:40', 'min:2'],
            'specialization' => ['nullable', 'max:40', 'min:2'],
            'degree' => ['nullable', 'max:40', 'min:2'],
            'school_type' => ['required'],
            'period_of_attendance_from' => ['required'],
            'period_of_attendance_to' => ['required'],
            'highest_level' => ['nullable','max:40', 'min:10', 'regex:/^[a-zA-Z ]*$/'],
            'year_graduate' => ['nullable', 'numeric'],
            'academics_honor_received' => ['nullable','max:40', 'min:10'],
            
        ];
    }
}
