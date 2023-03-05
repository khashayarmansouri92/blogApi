<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoStoreRequest;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Video\VideoRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function store(VideoStoreRequest $request)
    {
        $video = VideoRepository::store($request);

        return response()->json([
            'id' => $video->id,
        ],201);
    }

    public function show($id)
    {
        try {
            $video = VideoRepository::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Post not found'
            ], 404);
        }

        // The user was found, so return the response
        return response()->json([
            'title' => $video->title,
            'url' => $video->url,
            'comments'=> CommentRepository::getArrayInfo($video),
            'username'=> $video->user->username,
        ], 200);
    }
}
