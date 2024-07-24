<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function postsByUser(Request $request, User $user)
    {
        $perPage = $request['perPage'];
        $page = $request['page'];

        $posts = $user->posts()->paginate($perPage, page: $page);

        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request)
    {

        $posts = $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image_url' => $request->image_url,
        ]);

        return new PostResource($posts);
    }

    public function update(UpdatePostRequest $request, Post $id)
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
