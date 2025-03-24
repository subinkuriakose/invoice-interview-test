<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class LeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'regex:/[0-9]{10}/'],
            'contact_type' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute is required',
            'email.required' => ':attribute is required',
            'phone.required' => ':attribute is required',
            'phone.regex' => ':attribute must be a valid 10 digit mobile phone number',
            'contact_type.required' => ':attribute is required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',
            'contact_type' => 'Contact type',
        ];
    }
}
