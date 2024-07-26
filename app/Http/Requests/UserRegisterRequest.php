<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "string|max:25",
            "email" => "required|string|unique:users|email|max:25",
            "password" => "required|string|max:20|confirmed",
        ];
    }

    /**
     * Get the validation errors that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Please enter an email',
            'email.email' => 'Please enter a valid email',
            'email.unique' => 'Email is already used',
            'password.required' => 'Please enter a password',
        ];
    }
}
