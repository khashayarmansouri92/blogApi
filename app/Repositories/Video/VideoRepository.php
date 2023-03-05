<?php

namespace App\Repositories\Video;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class VideoRepository
{
    public static function store($request, $comment)
    {
        $video = new Video();
        $video->title = $request->title;
        $video->url = $request->url;
        $video->comment_id = $comment->id;
        $video->save();

        return $video;
    }

    public static function findOrFail($id)
    {
        return Video::findOrFail($id);
    }

    public static function find($id)
    {
        return Video::find($id);
    }

    public static function getArrayInfo($post)
    {
        $array = array();

        if (count($post->comments))
        {
            foreach ($post->comments as $key => $comment)
            {
                $array[$key][] = $comment->user->username;
                array_push($array[$key], $comment->body);
            }
        }

        return $array;
    }
}
