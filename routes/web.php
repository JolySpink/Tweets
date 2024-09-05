<?php

use App\Http\Controllers\Back\TweetsController;
use App\Http\Controllers\Back\TweetSendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [TweetsController::class, 'vue'])->name('messages');
Route::post('/messagesSend', [TweetSendController::class, 'Send'])->name('SendMessage');
require __DIR__.'/auth.php';
