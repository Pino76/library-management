<?php

namespace App\Http\Requests\Book;

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
            "title" => "required",
            "isbn" => "required|string|size:17",
            "author" => "required",
            "genre_id" => "required|integer|min:1",
            "quantity" => "required|integer",
            "year" => "required|integer",
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Il campo titolo è obbligatorio",
            "isbn.required" => "Il campo isbn è obbligatorio",
            "isbn.string" => "Il campo isbn non è valido",
            "isbn.size" => "Il campo isbn deve essere di 17 caratteri",
            "author.required" => "Il campo autore è obbligatorio",
            "genre_id.required" => "Il campo genere è obbligatorio",
            "genre_id.integer" => "Il campo genere deve essere numerico",
            "genre_id.min" => "Il campo genere deve essere valorizzato",
            "quantity.required" => "Il campo quantità è obbligatorio",
            "quantity.integer" => "Il campo quantità deve essere numerico",
            "year.required" => "Il campo anno è obbligatorio",
            "year.integer" => "Il campo anno deve essere è numerico",
        ];
    }
}
