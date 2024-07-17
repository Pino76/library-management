<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class SearchBookRequest extends FormRequest
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
            "title" => ["required_without:author", "nullable", "string"],
            "author" => ["required_without:title", "nullable", "string"],
        ];
    }

    public function messages()
    {
        return [
            "title.required_without" => "Da compilare almeno un campo",
            "author.required_without" => "Da compilare almeno un campo",
        ];
    }
}
