<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'name'          => 'required:string',
            'bio'           => 'required:string',
            'date_of_barth' => 'required:date',
            'nationality'   => 'required:string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "name is required",
            'bio.required' => "bio is required",
            'date_of_barth.required' => "date_of_barth is required",
            'nationality.required' => "nationality is required",
        ];
    }
}
