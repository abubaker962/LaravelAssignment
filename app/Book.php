<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'book_name', 'publisher_name', 'isbn', 'cover_image',
    ];
}
