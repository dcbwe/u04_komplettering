<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminListController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [MediaController::class, 'search'])->name('media.search');

Route::get('/movie/{id}', [MediaController::class, 'showMovie'])->name('media.movie');
Route::get('/tv/{id}', [MediaController::class, 'showTv'])->name('media.tv');
Route::get('/person/{id}', [MediaController::class, 'showPerson'])->name('media.person');

// account
Route::prefix('auth')->group(function () {
    Route::get('login', [UserController::class, 'loginForm'])->name('users.login.form');
    Route::post('login', [UserController::class, 'login'])->name('users.login')->middleware('throttle:5,1');
    
    Route::get('signup', [UserController::class, 'signupForm'])->name('users.signup.form');
    Route::post('signup', [UserController::class, 'signup'])->name('users.signup');
    
    Route::get('logout', [UserController::class, 'logout'])->name('users.logout')->middleware('auth');
});

// Auth routes
Route::middleware('auth')->group(function () {
    Route::resource('lists', ListController::class)->except(['edit', 'update', 'create']);
    Route::post('/lists/{list}/add', [ListController::class, 'addMedia'])->name('lists.addMedia');
    Route::delete('/lists/{list}/remove', [ListController::class, 'removeMedia'])->name('lists.removeMedia');

    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    Route::post('/rating', [RatingController::class, 'store'])->name('rating.store');
});

// Admin routes
Route::middleware(['auth', 'can:isAdmin'])->prefix('admin')->group(function () {
    Route::get('/reports/reviews', [AdminReviewController::class, 'index'])->name('admin.reports.reviews');
    Route::post('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('admin.reviews.approve');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');

    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::post('/users/{user}/toggle', [AdminUserController::class, 'toggleActive'])->name('admin.users.toggle');

    Route::get('/lists', [AdminListController::class, 'index'])->name('admin.lists');
    Route::delete('/lists/{list}', [AdminListController::class, 'destroy'])->name('admin.lists.destroy');
});

Route::fallback(fn() => response()->view('errors.404', [], 404));

Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth', 'verified'])->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('settings.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('settings.destroy');
});

Route::post('/favorites/{id}/{type}', [UserController::class, 'toggle'])
    ->middleware('auth')
    ->name('favorites.toggle');

Route::post('/review/edit-mode', fn() => back()->with('editing_review', true))->name('review.edit-mode');
Route::post('/review/cancel-edit', function () {
    session()->forget('editing_review');
    return back();
})->name('review.cancel-edit');
    

require __DIR__.'/auth.php';
