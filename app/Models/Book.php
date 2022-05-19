<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'book_id';
    protected $with = ['category', 'language'];

    protected $fillable = [
        'title' ,
        'price' ,
        'available' ,
        'author_id' ,
        'category_id' ,
        'language_id' ,
        'publication_year' ,
        'created_at' ,
        'updated_at'
    ];


    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
