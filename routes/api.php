<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;

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


Route::get('posts', [PageController::class, 'index']);
Route::get('post-details/{id}', [PageController::class, 'post_details']);

Route::post('register', [userController::class, 'register']);
Route::post('login', [userController::class, 'login']);

Route::post('blog-post', [BlogController::class, 'blog_post']);
Route::get('all-post', [BlogController::class, 'all_post']);
Route::get('get-post/{id}', [BlogController::class, 'get_post']);
Route::post('edit-post/{id}', [BlogController::class, 'edit_post']);
Route::any('delete-post/{id}', [BlogController::class, 'delete_post']);