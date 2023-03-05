<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function store(PostStoreRequest $request)
    {
        $post = PostRepository::store($request);

        return response()->json([
            'id' => $post->id,
        ], 201);
    }

    public function show($id)
    {
        try {
            $post = PostRepository::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Post not found'
            ], 404);
        }

        // The user was found, so return the response
        return response()->json([
            'title' => $post->title,
            'content' => $post->content,
            'comments' => CommentRepository::getArrayInfo($post),
            'username' => $post->user->username,
        ], 200);
    }
}
