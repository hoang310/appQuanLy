<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $fillable = [
        'user_id',
        'borrow_date',
        'due_date',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function borrowDetails()
    {
        return $this->hasMany(BorrowDetail::class);
    }
}
