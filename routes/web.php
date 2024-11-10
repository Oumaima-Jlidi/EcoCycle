<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollecteController;
use App\Http\Controllers\DechetController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\CategorieController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Artisan;
use App\Models\Event;

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
Route::get('/shop', [ProduitController::class, 'indexFront'])->name('produits.indexFront');
Route::get('/shop/{id}', [ProduitController::class, 'show'])->name('produits.show');


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
    Route::post('/events/{event}/register', [RegistrationController::class, 'register'])->name('events.register');
    //Route::post('/event/{event}/feedback', [EventController::class, 'storeFeedback'])->name('event.feedback');
    Route::get('/events', [EventController::class, 'indexFront'])->name('events.indexFront');
    Route::get('/events/create', [EventController::class, 'createFront'])->name('events.createFront');
    Route::post('/events', [EventController::class, 'storefront'])->name('events.storefront');
    Route::get('events/{event}/editfront', [EventController::class, 'editFront'])->name('events.editfront');
    Route::put('events/{event}', [EventController::class, 'updatefront'])->name('events.updatefront');
    Route::delete('events/{event}', [EventController::class, 'destroyFront'])->name('events.destroy');
    Route::get('events/search-events', [EventController::class, 'search'])->name('events.search');

    Route::get('/send-reminders', function () {
        Artisan::call('event:send-reminders');
        return 'Reminders sent!';
    });
    Route::get('events/{id}/export-pdf', [EventController::class, 'exportPdf'])->name('events.exportPdf');
    Route::post('/events/{event}/feedback', [FeedbackController::class, 'submitFeedback'])->name('events.feedback');
    //Route::get('/events/details/{event}', [EventController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/feedback', [FeedbackController::class, 'store'])->name('events.feedback');
    //Route::put('/feedback/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update');
    //Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroyF'])->name('feedback.destroy');
    Route::match(['get', 'post'], '/events/details/{event}', [EventController::class, 'show'])->name('events.show');

    Route::get('/calender', function () {
        $events = Event::all(['id', 'title as title', 'start_date as start', 'end_date as end']); 
        return response()->json($events);
    });
    Route::get('/calender/events', function () {
        return view('Front.pages.event.calendar');  // Chemin vers votre vue calendar.blade.php
    })->name('events.calender');

    


});




Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [OrderController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/sales', [OrderController::class, 'salesTot'])->name('sales.total');
    Route::get('/users/export/pdf', [UserController::class, 'exportToPDF'])->name('users.export.pdf');
    Route::resource('/event', EventController::class)->only(['index', 'store', 'destroy', 'edit', 'update']);
    Route::resource('/feedback', FeedbackController::class)->only(['index', 'store', 'destroy', 'edit', 'update']);

    Route::resource('/produit', ProduitController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/role', RoleController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/order', OrderController::class)->only(['index', 'orderCount', 'store', 'show', 'update', 'destroy']);
    Route::fallback([NotFoundController::class, 'index']);
    Route::resource('/categories', CategorieController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::resource('/collectes', CollecteController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/dechets', DechetController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::post('/feedback/{id}/toggle', [FeedbackController::class, 'ActivateDesactivateStatus'])->name('feedback.toggle');


});


require __DIR__ . '/auth.php';
