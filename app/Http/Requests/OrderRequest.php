<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'books'         => 'required|array',
            'books.*.book_id' => 'required|exists:books,id',
            'books.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'books.required' => 'You must select at least one book.',
            'books.array' => 'The books field must be an array.',
            'books.*.book_id.required' => 'Each book entry must have a book ID.',
            'books.*.book_id.exists' => 'The selected book ID is invalid.',
            'books.*.quantity.required' => 'Each book entry must have a quantity.',
            'books.*.quantity.integer' => 'The quantity must be an integer.',
            'books.*.quantity.min' => 'The quantity must be at least 1.',
        ];
    }
}
