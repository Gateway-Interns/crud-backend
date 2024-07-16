<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

<<<<<<< HEAD
=======

>>>>>>> e860d04fe35b358f64d9b915bddd45cf64711d70
    protected  $fillable = [
        'title',
        'body',
        'image_url',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
