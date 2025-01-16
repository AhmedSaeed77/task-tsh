<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title'         => 'required:string',
            'description'   => 'required:string',
            'price'         => 'required:date',
            'stock'         => 'required:string',
            'author_id'     => ['required', Rule::exists('authors','id')] ,
            'category_id'   => ['required', Rule::exists('categories','id')] ,
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "title is required",
            'description.required' => "description is required",
            'price.required' => "price is required",
            'stock.required' => "stock is required",
            'author_id.required' => "author is required",
            'category_id.required' => "category is required",
        ];
    }
}
