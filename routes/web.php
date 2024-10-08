<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotFoundController;


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


Route::get('/AddPost', [PostController::class, 'create'])->name('posts.add');
Route::get('/Forum', [PostController::class, 'Forum'])->name('forum.index');
Route::get('/comments', [ReplayController::class, 'comments'])->name('comments.index');
Route::post('/posts/store', [PostController::class, 'AddPost'])->name('posts.store');
Route::delete('/posts/{id}', [PostController::class, 'delete'])->name('posts.delete')->middleware('auth');
Route::get('/posts/{id}', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::match(['get', 'post'], '/show/{id}', [ReplayController::class, 'show'])->name('show.index');
Route::delete('/replay/{id}', [ReplayController::class, 'delete'])->name('replays.delete')->middleware('auth');

Route::get('/Replays/{id}', [ReplayController::class, 'edit'])->name('replay.edit')->middleware('auth');
Route::put('/Replays/{id}', [ReplayController::class, 'update'])->name('replays.update');


Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::get('/Posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/Replays', [ReplayController::class, 'index'])->name('replays.index');


Route::get('/', function () {
    return view('TemplateForum.AddSujet');
});

 
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [OrderController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/sales', [OrderController::class, 'salesTot'])->name('sales.total');

    Route::resource('/produit', ProduitController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/role', RoleController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/order', OrderController::class)->only(['index', 'orderCount', 'store', 'show', 'update', 'destroy']);
    Route::fallback([NotFoundController::class, 'index']);

});


require __DIR__.'/auth.php';