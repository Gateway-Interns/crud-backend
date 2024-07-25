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
        $query = Post::query();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('body', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        if ($request->filled('order_by') && $request->filled('order_direction')) {
            $query->orderBy($request->order_by, $request->order_direction);
        }

        $posts = $query->paginate(4);

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