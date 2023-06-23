<?php

use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    'as'=>'frontend.',
], function(){
    Route::resource('feeds', FeedController::class);
});



