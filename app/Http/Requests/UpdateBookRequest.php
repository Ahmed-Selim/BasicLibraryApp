<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'title' => ['required', 'string', 'unique:books,title,'.$this->id ],
            // 'price' => ['required', 'integer', 'min:0', 'max:99900'],
            // // 'available' => $this->faker->boolean(),
            // 'available' => ['required', 'boolean'],
            // 'author_id' => ['required', 'string', ''],
            // 'category_id' => Category::all()->random()->category_id,
            // 'language_id' => Language::all()->random()->language_id,
            // 'publication_year' => $this->faker->year()
        ];
    }
}
