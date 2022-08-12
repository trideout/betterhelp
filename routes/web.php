<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/login', [UserController::class, 'login'])->name('loginRegister');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [UserController::class, 'loginPost'])->name('login');

Route::middleware(['auth.basic'])->group(function () {
    Route::get('/', [QuestionController::class, 'index'])->name('questions');
    Route::post('/question', [QuestionController::class, 'askQuestion'])->name('askQuestion');
    Route::get('/question/{id}', [QuestionController::class, 'show'])->name('showQuestion');
    Route::post('/question/{id}', [QuestionController::class, 'submitAnswer'])->name('submitAnswer');

    Route::get('/stats', [StatsController::class, 'index'])->name('stats');
});
