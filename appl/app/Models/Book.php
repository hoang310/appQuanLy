<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'isbn',
        'author_id',
        'category_id',
        'publisher',
        'publish_year',
        'quantity',
        'available_quantity',
        'image',
        'description'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowDetails()
    {
        return $this->hasMany(BorrowDetail::class);
    }
}
