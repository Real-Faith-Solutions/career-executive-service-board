<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProfile201Req extends FormRequest
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
            'title' => 'required',
            'status' => 'required',
            'email' => 'required|email|unique:profile_tblMain,email',
            'lastname' => 'required|min:2',
            'firstname' => 'required|min:2',
            'middlename' => 'nullable|min:2',
            'birthdate' => 'required|date|before_or_equal:now',
            'gender' => 'required',
            'civil_status' => 'required',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'single_parent' => 'required',
            'member_of_indigenous_group' => 'required',
            'person_with_disability' => 'required',
            'citizenship' => 'required',
        ];
    }
}
