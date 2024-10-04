<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
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


Route::get('/AddPost', [PostController::class, 'AddPost'])->name('posts.add');
Route::get('/Forum', [PostController::class, 'Forum'])->name('forum.index');

Route::get('/Posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/Replays', [ReplayController::class, 'index'])->name('replays.index');



Route::get('/home', function () {
    return view('Front.welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('TemplateForum.dashPosts');
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

    Route::resource('/produit', ProduitController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/role', RoleController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/order', OrderController::class)->only(['index', 'orderCount', 'store', 'show', 'update', 'destroy']);
    Route::fallback([NotFoundController::class, 'index']);
    Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');

});


require __DIR__.'/auth.php';