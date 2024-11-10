<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollecteController;
use App\Http\Controllers\DechetController;


use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
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
Route::get('/subjects/search', [PostController::class, 'search'])->name('subjects.search');
 
Route::get('/Replays/{id}', [ReplayController::class, 'edit'])->name('replay.edit')->middleware('auth');
Route::put('/Replays/{id}', [ReplayController::class, 'update'])->name('replays.update');

Route::post('/like/{likeableId}/{likeableType}', [LikeController::class, 'likeOrDislike'])->name('like')->middleware('auth');

Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::get('/Posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/Replays', [ReplayController::class, 'index'])->name('replays.index');
Route::get('/produits', [ProduitController::class, 'indexFront'])->name('produits.indexFront');
Route::get('/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');
Route::post('/add-to-cart', [OrderController::class,'addToCart'])->name('add.to.cart');

Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::patch('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity']);
 Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');



Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/', function () {
    return view('TemplateForum.dashPosts');
});
 

Route::get('/collects', [CollecteController::class, 'indexfront'])->name('collects.indexfront');


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('TemplateForum.AddSujet');
    });
    Route::fallback([NotFoundController::class, 'index']);
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
     Route::get('/change-password', [PasswordController::class, 'changePassword'])->name('password.change');
     Route::post('/change-password', [PasswordController::class, 'updatePassword'])->name('password.update');
 
});




Route::middleware(['auth', 'admin'])->group(function () {
   
    Route::get('/admin', [OrderController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/sales', [OrderController::class, 'salesTot'])->name('sales.total');


    Route::get('/users/export/pdf', [UserController::class, 'exportToPDF'])->name('users.export.pdf');

    Route::resource('/produit', ProduitController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/role', RoleController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/order', OrderController::class)->only(['index', 'orderCount', 'store', 'show', 'update', 'destroy']);
    
    Route::fallback([NotFoundController::class, 'index']);
    Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::resource('/collectes', CollecteController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/dechets', DechetController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);


});


require __DIR__ . '/auth.php';
