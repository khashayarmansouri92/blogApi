<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

Route::apiResource('/users', UserController::class)->only(['store']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('/posts', PostController::class);
    Route::apiResource('/users', UserController::class)->except(['store']);

    Route::POST('/post/{id}/comment', [CommentController::class, 'postStore']);
    Route::POST('/video/{id}/comment', [CommentController::class, 'videoStore']);
});
