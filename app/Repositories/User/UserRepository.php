<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public static function store($request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->save();

        return $user;
    }
    public static function findOrFail($id)
    {
        return User::findOrFail($id);
    }
}
