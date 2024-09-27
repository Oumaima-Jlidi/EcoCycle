<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplayController;
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


Route::get('/AddPost', [PostController::class, 'AddPost'])->name('posts.add');

Route::get('/Posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/Replays', [ReplayController::class, 'index'])->name('replays.index');
