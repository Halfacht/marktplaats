<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BiddingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserAdvertisementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('advertisements', AdvertisementController::class)->except(['create', 'edit']);
Route::get('user-advertisements', [UserAdvertisementController::class, 'index'])->middleware('auth');

Route::get('categories', [CategoryController::class, 'index']);

Route::post('advertisements/{advertisement}/biddings', [BiddingController::class, 'store'])->middleware('auth');

Route::resource('messages', MessageController::class)->only(['index', 'show', 'store']);

Route::get('check-auth', [AuthenticatedSessionController::class, 'checkAuth']);

require __DIR__.'/auth.php';
