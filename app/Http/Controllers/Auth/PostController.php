<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\Auth\PostResource;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return new PostResource($post);
    }
}