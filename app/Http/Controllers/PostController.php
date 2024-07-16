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

        $posts = $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image_url' => $request->image_url,
        ]);

        return new PostResource($posts);
    }

    public function update(UpdatePostRequest $request,Post $id)
    {

        
        Gate::authorize('modify', $id);

        $id->update([
            'title' => $request->title,
            'body' => $request->body,
            'image_url' => $request->image_url,
        ]);


        return new PostResource($id);
    }

  
}
