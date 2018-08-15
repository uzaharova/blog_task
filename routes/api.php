<?php

use Illuminate\Http\Request;

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

Route::post('/post_create', 'PostsController@post_create');
Route::post('/add_rating', 'RatingsController@add_rating');
Route::get('/top_posts', 'PostsController@top_posts');
Route::get('/author_list', 'AuthorController@author_list');
