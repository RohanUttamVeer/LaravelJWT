<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailRequest extends FormRequest
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
            "name" => "required|string|max:25",
            "email" => "required|string|email|max:25",
            "image" => 'required|string|max:255',
            "phone" => 'required|string|max:25',
            "address" => 'required|string|max:255',
            "latitude" => 'required|string|max:255',
            "longitude" => 'required|string|max:255',
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
        ];
    }
}
