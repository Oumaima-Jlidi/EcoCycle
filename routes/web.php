<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
 


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


Route::get('/', function () {
    return view('Front.welcome');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', function () {
        return view('Back.pages.index');
    })-> name('dashboard');
Route::resource('/produit', ProduitController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
Route::resource('/users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
Route::resource('/role', RoleController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
Route::resource('/order', OrderController::class)->only(['index', 'store', 'show', 'update', 'destroy']);



});

require __DIR__.'/auth.php';