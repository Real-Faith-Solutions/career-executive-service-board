<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpouseStoreRequest extends FormRequest
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

            'last_name' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'first_name' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'middle_name' => ['nullable', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'name_extension' => ['nullable', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'occupation' => ['nullable', 'max:40', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'employer_bussiness_name' => ['nullable', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'employer_bussiness_address' => ['nullable', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'employer_bussiness_telephone' => ['nullable', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
     
        ];
    }
}
