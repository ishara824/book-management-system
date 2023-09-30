<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function stock()
    {
        return $this->belongsTo(BookStock::class,'id','book_id');
    }

    protected $with = ['stock'];
}
