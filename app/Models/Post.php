<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected  $fillable = [
        'title',
        'body',
        'image_url',
    ];
    public function scopeFilterByUserId($query, $userId)
    {
        if ($userId) {
            return $query->where('user_id', $userId);
        }

        return $query;
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('body', 'LIKE', "%{$search}%");
            });
        }

        return $query;
    }

    public function scopeFilterByCreatedAt($query, $createdAt)
    {
        if ($createdAt) {
            return $query->whereDate('created_at', $createdAt);
        }

        return $query;
    }

    public function scopeOrderByFields($query, $orderBy, $orderDirection)
    {
        if ($orderBy && $orderDirection) {
            return $query->orderBy($orderBy, $orderDirection);
        }

        return $query;
    }
    protected $casts = [
        'created_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}