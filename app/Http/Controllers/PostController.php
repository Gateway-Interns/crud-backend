<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Http\Resources\Auth\PostResource;
use Illuminate\Http\Request;
class PostController extends Controller
{
    public function show(Post $post)
    {
        return new PostResource($post);
    }
    public function postsByUser(Request $request,User $user)
    {
          $perPage = $request['perPage'];
          $page= $request['page'];

        $posts = $user->posts()->paginate($perPage, page: $page);

        return PostResource::collection($posts);
    }
}