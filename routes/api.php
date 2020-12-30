<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Post API routes
 */
Route::post('/posts/{post}/like/{user}', 'PostController@like')->name('api.posts.like');

Route::post('/posts/{post}/dislike/{user}', 'PostController@dislike')->name('api.posts.dislike');

Route::get('/posts/{post}/isLikedBy/{user}', 'PostController@isLikedBy')->name('api.posts.isLikedBy');
