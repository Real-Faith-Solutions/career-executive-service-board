<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErisStoreRequest extends FormRequest
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
            'cesno' => ['required', 'unique:erad_tblMain,cesno'],
            'emailadd' => ['nullable', 'unique:erad_tblMain,emailadd'],
            'contactno' => ['nullable', 'unique:erad_tblMain,contactno'],
            'mobileno' => ['nullable', 'unique:erad_tblMain,mobileno'],
            'faxno' => ['nullable', 'unique:erad_tblMain,faxno'],
        ];
    }

    public function messages()
    {
        return [
            'cesno.required' => 'The CESNO number field is required.',
            'cesno.unique' => 'The CESNO number you entered is already in use.',
                
            'emailadd.required' => 'The email address field is required.',
            'emailadd.unique' => 'The email address you entered is already in use.',
                
            'contactno.required' => 'The contact number field is required.',
            'contactno.unique' => 'The contact number you entered is already in use.',
                
            'mobileno.required' => 'The mobile number field is required.',
            'mobileno.unique' => 'The mobile number you entered is already in use.',
                
            'faxno.required' => 'The fax number field is required.',
            'faxno.unique' => 'The fax number you entered is already in use.',
        ];
    }
}
