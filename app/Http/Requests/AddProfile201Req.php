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

            'status' => ['required', 'max:20', 'min:5', 'regex:/^[a-zA-Z ]*$/'],
            'title' => ['required', 'max:40', 'min:1', 'regex:/^[a-zA-Z. ]*$/'],
            'lastname' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'firstname' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'name_extension' => ['max:40', 'min:1', 'regex:/^[a-zA-Z. ]*$/'],
            'middlename' => ['required', 'max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            'mi' => ['required', 'max:40', 'min:1', 'regex:/^[a-zA-Z. ]*$/'],
            'nickname' => ['max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            'birthdate' => ['required', 'regex:/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])*$/'],
            'birth_place' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'gender' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'gender_by_choice' => ['max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'civil_status' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'religion' => ['max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],

            'height' => ['required'],
            'weight' => ['required'],
            'member_of_indigenous_group' => ['max:40', 'min:1'],
            // 'moig_others' => ['max:40', 'min:1'],
            'single_parent' => ['max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            'citizenship' => ['required', 'max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            // 'dual_citizenship' => ['max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            'person_with_disability' => ['max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            // 'dependent_pwd_input' => ['max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            'gsis' => ['required'],
            'pagibig' => ['required'],
            'philhealth' => ['required'],
            'sss_no' => ['required'],
            'tin' => ['required'],

        ];
    }
}
