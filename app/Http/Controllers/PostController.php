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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findorFail($id);
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        //$userId = auth()->user()->id;
        $post = Post::findOrFail($id);
        Gate::authorize('modify', $post);
        //$post = Post::find($id);


        // $post->title = $request->title;
        // $post->body = $request->body;
        // $post->image_url = $request->image_url;
        // $post->save();
        // if ($post->save()) {
        //     return new PostResource($post);
        // }

        // Update the post attributes
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image_url' => $request->image_url,
        ]);


        return new PostResource($post);

        // $product = Post::findorFail($post);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
