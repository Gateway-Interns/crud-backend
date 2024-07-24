<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'data',
        'user_id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'read_at',

    ];
    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
