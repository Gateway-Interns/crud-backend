<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->filterByUserId($request->user_id)
            ->search($request->search)
            ->filterByCreatedAt($request->created_at)
            ->orderByFields($request->order_by, $request->order_direction)
            ->paginate(4);

        return PostResource::collection($posts);
    }

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

    public function destroy(Post $post)
    {
        Gate::authorize('modify', $post);

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}