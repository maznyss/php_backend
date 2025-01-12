<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);

//Route::middleware('auth:sanctum')->group(function () {

    // Resource Routes
    Route::apiResource('users', UserController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('comments', CommentController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('votes', VoteController::class);
    Route::apiResource('tags', TagController::class);

    // Get all comments for a specific post
    Route::get('posts/{id}/comments', [PostController::class, 'comments']);

    // Get all posts by a specific user
    Route::get('users/{id}/posts', [UserController::class, 'posts']);

    // Upvote a post
    Route::post('posts/{id}/upvote', [VoteController::class, 'upvote']);

    // Downvote a post
    Route::post('posts/{id}/downvote', [VoteController::class, 'downvote']);

//});