<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TimerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return auth()->check() ? redirect()->route('timers.index') : redirect()->route('login.show');
});


Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout.perform');

Route::middleware('auth')->group(function () {
    Route::resource('timers', TimerController::class)->except(['show']);
    Route::get('history', [TimerController::class, 'history'])->name('timers.history');
    Route::post('timers/{timer}/complete', [TimerController::class, 'markCompleted'])->name('timers.complete');
});
