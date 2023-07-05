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

            // 'status' => ['required', 'max:20', 'min:5', 'regex:/^[a-zA-Z ]*$/'],
            // 'title' => ['required', 'max:40', 'min:1', 'regex:/^[a-zA-Z. ]*$/'],
            // 'lastname' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            // 'firstname' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            // 'name_extension' => ['required', 'max:40', 'min:1', 'regex:/^[a-zA-Z. ]*$/'],
            // 'middlename' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            // 'mi' => ['required', 'max:40', 'min:1', 'regex:/^[a-zA-Z. ]*$/'],
            // 'nickname' => ['max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            // 'birthdate' => ['required', 'regex:/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])*$/'],
            // 'birth_place' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            // 'gender' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            // 'gender_by_choice' => ['max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            // 'civil_status' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            // 'religion' => ['max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            // 'height' => ['required', 'regex:/^\d+(\.\d{1,2})*$/'],
            // 'weight' => ['required', 'regex:/^\d+(\.\d{1,2})*$/'],
            // 'member_of_indigenous_group' => ['max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            // 'moig_others' => ['max:40', 'min:4', 'regex:/^[a-zA-Z ]*$/'],
            // 'single_parent' => ['max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            // 'citizenship' => ['required', 'max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            // 'dual_citizenship' => ['max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            // 'person_with_disability' => ['max:40', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            // 'dependent_pwd_input' => ['max:40', 'min:4', 'regex:/^[a-zA-Z ]*$/'],
            // 'gsis' => ['required', 'max:30', 'min:4', 'regex:/^[\d+\+]*$/'],
            // 'pagibig' => ['required', 'max:30', 'min:4', 'regex:/^[\d+\+]*$/'],
            // 'philhealth' => ['required', 'max:30', 'min:4', 'regex:/^[\d+\+]*$/'],
            // 'sss_no' => ['required', 'max:30', 'min:4', 'regex:/^[\d+\+]*$/'],
            // 'tin' => ['required', 'max:30', 'min:4', 'regex:/^[\d+\+]*$/'],

        ];
    }
}
