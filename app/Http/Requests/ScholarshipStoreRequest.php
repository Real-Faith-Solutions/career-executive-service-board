<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScholarshipStoreRequest extends FormRequest
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
            
            'type' => ['required'],
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],

        ];
    }
}
