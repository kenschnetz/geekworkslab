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
        return view('components.layout', ['name' => 'Latest Submissions', 'view' => 'home', 'properties' => []]);
    })->name('home');

    Route::get('/post/{post_id?}', function ($post_id = null) {
        return view('components.layout', ['name' => 'Post', 'view' => 'post', 'properties' => ['post_id' => $post_id]]);
    })->name('post');

    Route::get('/items', function () {
        return view('items');
    })->name('items');

    Route::get('/monsters', function () {
        return view('monsters');
    })->name('monsters');

    Route::get('/hooks', function () {
        return view('hooks');
    })->name('hooks');

    Route::get('/abilities', function () {
        return view('abilities');
    })->name('abilities');

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
