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

Route::get('/', 'App\Http\Controllers\HomeController@index');

Route::get('/contact');

Route::get('/about', 'App\Http\Controllers\AboutController@index');
Route::get('/test', function () {
    return view('test', [
        'name' => request('name')
    ]);
});
Route::get('posts/{post}', 'App\Http\Controllers\PostsController@show');

// RESTFUL PLAYGROUND
Route::get('/articles', 'App\Http\Controllers\ArticlesController@index')->name('articles.index');
Route::post('/articles', 'App\Http\Controllers\ArticlesController@store');
Route::get('/articles/create', 'App\Http\Controllers\ArticlesController@create');
Route::get('/articles/{article}', 'App\Http\Controllers\ArticlesController@show')->name('articles.show');
Route::get('articles/{article}/edit', 'App\Http\Controllers\ArticlesController@edit');
Route::put('articles/{article}', 'App\Http\Controllers\ArticlesController@update');
