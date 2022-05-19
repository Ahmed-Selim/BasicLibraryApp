<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Borrow extends Pivot
{
    protected $primaryKey = 'borrow_id';
    // protected $with = ['book', 'borrower'];

    protected $fillable = [
        'user_id' ,
        'book_id' ,
        'return_date',
        'created_at' ,
        'updated_at'
    ];

    public function book()
    {
        return $this->hasOne(Book::class, 'book_id', 'book_id');
    }

    public function borrower()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
}
