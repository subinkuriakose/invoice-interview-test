<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class RegistrationRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:5', 'max:15', 'confirmed'],
            'password_confirmation' => ['required'],
            'contact_type' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute is required',
            'email.required' => ':attribute is required',
            'password.required' => ':attribute is required',
            'password.min' => ':attribute must be minimum 5 characters in length',
            'password.max' => ':attribute should not exceed 15 characters in length',
            'contact_type.required' => ':attribute is required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'contact_type' => 'Contact type',
        ];
    }
}
