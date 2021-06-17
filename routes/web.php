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

    Route::get('/dashboard', function () {
        return view('components.layout', ['name' => 'Dashboard', 'view' => 'dashboard', 'properties' => []]);
    })->name('dashboard')->middleware('auth');;

    Route::get('/', function () {
        return view('components.layout', ['name' => 'Latest Submissions', 'view' => 'home', 'properties' => []]);
    })->name('home');

    Route::get('/items', function () {
        return view('components.layout', ['name' => 'Latest Items', 'view' => 'items', 'properties' => []]);
    })->name('items');

    Route::get('/monsters', function () {
        return view('components.layout', ['name' => 'Latest Monsters', 'view' => 'monsters', 'properties' => []]);
    })->name('monsters');

    Route::get('/hooks', function () {
        return view('components.layout', ['name' => 'Latest Hooks', 'view' => 'hooks', 'properties' => []]);
    })->name('hooks');

    Route::get('/abilities', function () {
        return view('components.layout', ['name' => 'Latest Abilities', 'view' => 'abilities', 'properties' => []]);
    })->name('abilities');

    Route::get('/art', function () {
        return view('components.layout', ['name' => 'Latest Art', 'view' => 'art', 'properties' => []]);
    })->name('art');

    Route::get('/post/{post_id?}', function ($post_id = null) {
        return view('components.layout', ['name' => 'Post', 'view' => 'post', 'properties' => ['post_id' => $post_id]]);
    })->name('post');
