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
            'school_code' => ['required', 'min:1'],
            'major_code' => ['nullable', 'min:1'],
            'degree_code' => ['nullable', 'min:1'],
            'school_type' => ['required'],
            'period_of_attendance_from' => ['required'],
            'period_of_attendance_to' => ['required'],
            'highest_level' => ['nullable','max:40', 'min:10', 'regex:/^[a-zA-Z ]*$/'],
            'academics_honor_received' => ['nullable','max:40', 'min:10'],

        ];
    }
}
