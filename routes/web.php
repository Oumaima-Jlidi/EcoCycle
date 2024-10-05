<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

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


Route::get('/AddPost', [PostController::class, 'AddPost'])->name('posts.add');

Route::get('/Posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/Replays', [ReplayController::class, 'index'])->name('replays.index');
Route::get('/produits', [ProduitController::class, 'indexFront'])->name('produits.indexFront');
Route::get('/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');
Route::post('/add-to-cart', [OrderController::class,'addToCart'])->name('add.to.cart');

Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::patch('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity']);

// Route to remove an item from the cart
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
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
});


require __DIR__ . '/auth.php';
