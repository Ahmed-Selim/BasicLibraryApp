<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreBookRequest extends FormRequest
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
            'title' => ['required', 'string', 'unique:books', 'min:8'],
            'price' => ['required', 'integer', 'min:0', 'max:99900'],
            'available' => ['required', 'boolean'],
            'author_id' => ['required', 'integer', 'exists:authors'],
            'category_id' => ['required', 'integer', 'exists:categories'],
            'language_id' => ['required', 'integer', 'exists:languages'],
            'publication_year' => ['required', 'integer', 'digits:4', 'min:1900', 'max:'. Carbon::now()->year],
        ];
    }
}
