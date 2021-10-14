<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/tweets', [TweetController::class, 'index'])->name('home');
    Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
    Route::post('/profiles/{user:name}/follow', [FollowController::class, 'store'])->name('follows.store');
    Route::get('/profiles/{user:name}', [ProfileController::class, 'show'])->name('profiles.show');
    Route::get('/profiles/{user:name}/edit', [ProfileController::class, 'edit'])->middleware('can:edit,user')->name('profiles.edit');
});

