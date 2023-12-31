<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FatherStoreRequest extends FormRequest
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

            'father_last_name' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'father_first_name' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'father_middle_name' => ['nullable', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'father_name_extension' => ['nullable', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            
        ];
    }
}
