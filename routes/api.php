<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\SongController;
use App\Http\Controllers\API\UserSongController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register', [LoginController::class, 'register'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth:sanctum')->group(function () {
	Route::get('song', [SongController::class, 'index']);
	Route::post('save-song', [UserSongController::class, 'store']);
	Route::get('saved-song', [UserSongController::class, 'index']);
	Route::post('saved-song', [UserSongController::class, 'destroy']);
	// Route::resource('song', SongController::class);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });