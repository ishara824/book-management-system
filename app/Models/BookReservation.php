<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReservation extends Model
{
    use HasFactory;

    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }

    protected $with = ['book'];
}
