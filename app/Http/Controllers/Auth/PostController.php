<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Http\Resources\Auth\PostResource;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return new PostResource($post);
    }
    public function postsByUser(User $userId)
    {
       $posts = $userId->posts()->Paginate(4);
        return PostResource::collection($posts);
    }
}