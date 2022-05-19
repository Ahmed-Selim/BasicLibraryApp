<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class StoreBookBorrowRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,user_id'],
            // 'user_id' => ['required', 'integer', Rule::exists('users', 'user_id')->where('user_id', Auth::user()->id)],
            'book_id' => ['required', 'integer', Rule::exists('books', 'book_id')->where('available', 1)],
            'due_date' => ['sometimes', 'date', 'after_or_equal:'. Carbon::now()->addDay()]
        ];
    }
}
