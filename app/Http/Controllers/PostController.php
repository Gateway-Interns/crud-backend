<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{

 
    public function store(StorePostRequest $request)
    {
        Log::info('User ID:');
        $posts = $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image_url' => $request->image_url,
        ]);

        return new PostResource($posts);
    }

    public function update(UpdatePostRequest $request, $id)
    {

        $post = Post::findOrFail($id);
        Gate::authorize('modify', $post);

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image_url' => $request->image_url,
        ]);


        return new PostResource($post);
    }

  
}
