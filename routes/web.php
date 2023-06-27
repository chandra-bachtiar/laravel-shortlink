<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;

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

Route::get('/teams', function () {
    return view('teams');
})->name('teams');

Route::get('/test', function () {
    return view('test');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [LinkController::class, 'index'])->name('dashboard');
    Route::get('/create', [LinkController::class, 'createIndex'])->name('url.create');
    Route::get('/success', [LinkController::class, 'success'])->name('url.success');
    Route::get('/mobile-edit/{id}',[LinkController::class, 'mobileEdit'])->name('url.mobile-edit');
});

//create route group /link
Route::prefix('link')->group(function () {
    // check if user is logged in
    Route::post('/create', [LinkController::class, 'create'])->name('link.create');
    Route::post('/edit', [LinkController::class, 'edit'])->name('link.edit');
    Route::post('/delete', [LinkController::class, 'delete'])->name('link.delete');
    Route::get('/success', [LinkController::class, 'success'])->name('link.success');
});

require __DIR__ . '/auth.php';
//handle redirect
Route::get('/{shorturl}', [LinkController::class, 'redirect'])->name('link.redirect');
