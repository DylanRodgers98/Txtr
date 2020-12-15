<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

/**
 * Post routes
 */
Route::get('posts', 'PostController@index')->name('posts.index');

Route::get('posts/create', 'PostController@create')->name('posts.create');

Route::post('posts', 'PostController@store')->name('posts.store');

Route::get('posts/{post}', 'PostController@show')->name('posts.show');

Route::delete('posts/{post}', 'PostController@destroy')->name('posts.destroy');

/**
 * User routes
 */
Route::get('users', 'UserController@index')->name('users.index');

Route::get('users/create', 'UserController@create')->name('users.create');

Route::post('users', 'UserController@store')->name('users.store');

Route::get('users/{user}', 'UserController@show')->name('users.show');

Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
