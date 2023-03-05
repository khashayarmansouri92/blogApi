<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Video\VideoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function postStore(CommentStoreRequest $request, $post_id)
    {
        $post = PostRepository::find($post_id);
        $comment = CommentRepository::store($request, $post, 'post');

        return response()->json([
            'text' => $comment->text,
        ], 201);
    }

    public function videoStore(CommentStoreRequest $request, $video_id)
    {
        $video = VideoRepository::find($video_id);
        $comment = CommentRepository::store($request, $video, 'video');

        return response()->json([
            'text' => $comment->text,
        ], 201);
    }
}
