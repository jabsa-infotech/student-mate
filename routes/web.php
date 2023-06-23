<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// feeds, profile, friends

// Route::get('/feeds', [FeedController::class,'feeds'])->name('frontend.feeds');
// Route::post('/feeds',[FeedController::class,'store'])->name('frontend.feeds.store');
// Route::delete('/feeds/{feed}',[FeedController::class,'destroy'])->name('frontend.feeds.destroy');

// Route::get('/feeds/{feed}/edit', [FeedController::class,'edit'])->name('frontend.feeds.edit');
// Route::put('/feeds/{feed}/edit', [FeedController::class,'update'])->name('frontend.feeds.update');

Route::group([
    'as' => 'frontend.',
    'middleware' => 'auth'
], function () {
    Route::resource('feeds', FeedController::class);
    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
