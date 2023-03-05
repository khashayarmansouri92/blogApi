<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CommentRepository
{
    public static function store($request, $commentable, $type)
    {
        $comment = new Comment();
        $comment->text = $request->text;
        $comment->commentable_type = $type;
        $comment->commentable_id = $commentable->id;
        $comment->save();

        return $comment;
    }

    public static function findOrFail($id)
    {
        return Comment::findOrFail($id);
    }

    public static function find($id)
    {
        return Comment::find($id);
    }

    public static function getArrayInfo($commentable)
    {
        $array = array();

        if (count($commentable->comments))
        {
            foreach ($commentable->comments as $key => $comment)
            {
                $array[$key][] = $comment->commentable->user->username;
                array_push($array[$key], $comment->text);
            }
        }

        return $array;
    }
}
