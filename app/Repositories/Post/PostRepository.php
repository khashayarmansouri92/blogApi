<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PostRepository
{
    public static function store($request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();

        return $post;
    }

    public static function findOrFail($id)
    {
        return Post::findOrFail($id);
    }

    public static function find($id)
    {
        return Post::find($id);
    }
}
