<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'     => 'required:string',
            'email'    => 'required:string',
            'password' => 'required:date',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "name is required",
            'email.required' => "email is required",
            'password.required' => "password is required",
        ];
    }
}
