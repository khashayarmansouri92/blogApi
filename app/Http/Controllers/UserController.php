<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(UserStoreRequest $request)
    {
        $user = UserRepository::store($request);

        Auth::login($user);

        $token = $user->createToken('Token Name')->accessToken;

        return response()->json([
            'id' => $user->id,
            'token' => $token,
        ], 201);
    }

    public function show($id)
    {
        try {
            $user = UserRepository::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }
        // The user was found, so return the response
        return response()->json([
            'username' => $user->username,
        ], 200);
    }
}
