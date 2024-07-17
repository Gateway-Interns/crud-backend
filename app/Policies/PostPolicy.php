<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function modify(User $user, Post $post): Response
    {
        Log::info('Policy Check - User ID: ' . $user->id . ', Post User ID: ' . $post->user_id);

        return $user->id === $post->user_id ? Response::allow() : Response::deny('product is not urs');
    }
}
