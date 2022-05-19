<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $primaryKey = 'author_id';
    protected $with = ['books'] ;

    protected $fillable = [
        'author_name',
        'author_email',
        'created_at',
        'updated_at'
    ];

    public function books()
    {
        return $this->hasMany(Book::class,'author_id') ;
    }
}
