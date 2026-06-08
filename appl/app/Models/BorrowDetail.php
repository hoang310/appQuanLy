<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowDetail extends Model
{
    protected $fillable = [
        'borrow_id',
        'book_id',
        'quantity',
        'return_date'
    ];

    public function borrow()
    {
        return $this->belongsTo(Borrow::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
