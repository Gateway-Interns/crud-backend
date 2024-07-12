<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
     public function show($post_id)
    {
        $post = Post::find($post_id);

        if (!$post) {
            return response()->json(['message' => 'Post not available'], 404);
        }
        return response()->json([
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body,
            'image' => $post->image,
        ]);
    }
}