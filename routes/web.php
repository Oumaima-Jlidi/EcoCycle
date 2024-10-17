<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\CategorieController;


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
Route::get('/Forum', [PostController::class, 'Forum'])->name('forum.index');

Route::get('/Posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/Replays', [ReplayController::class, 'index'])->name('replays.index');
Route::get('/shop', [ProduitController::class, 'indexFront'])->name('produits.indexFront');
Route::get('/shop/{id}', [ProduitController::class, 'show'])->name('produits.show');


Route::get('/', function () {
    return view('TemplateForum.dashPosts');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [OrderController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/sales', [OrderController::class, 'salesTot'])->name('sales.total');

    Route::resource('/produit', ProduitController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/role', RoleController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/order', OrderController::class)->only(['index', 'orderCount', 'store', 'show', 'update', 'destroy']);
    Route::fallback([NotFoundController::class, 'index']);
    Route::resource('/categories', CategorieController::class)->only(['index', 'store', 'update', 'destroy']);
});


require __DIR__ . '/auth.php';
