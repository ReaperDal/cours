<?php

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
use App\Telegram\Handler;

//Route::post('/{token}/webhook', function () { $updates = Telegram::getWebhookUpdate(); return 'ok'; });
//Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
//Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
use App\Http\Controllers\GoogleController;

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/', function () {
    return view('welcome');
});

