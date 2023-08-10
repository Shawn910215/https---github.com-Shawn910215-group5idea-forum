<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('chirps', ChirpController::class);
Route::get('chirps/{chirp}', [ChirpController::class, 'show'])->name('chirps.show');



Route::post('chirps/{chirp}/upvote', [ChirpController::class, 'upvote'])->name('chirps.upvote');
Route::post('chirps/{chirp}/comment', [ChirpController::class, 'comment'])->name('chirps.comment');

Route::post('/chirps/{chirp}/comment', [ChirpController::class, 'comment'])->name('chirps.comment');

// Route::post('/chirps/{chirp}/comment', [ChirpController::class, 'storeComment'])->name('chirps.comment');


require __DIR__ . '/auth.php';
