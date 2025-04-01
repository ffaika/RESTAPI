<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\StatsController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('signup')->group(function () {
    Route::post('/',[SignupController::class, 'store']);
    Route::get('/', [SignupController::class, 'index']);
    Route::put('{id}/accept', [SignupController::class, 'accept']);
    Route::put('{id}/reject', [SignupController::class, 'reject']);
});

Route::prefix('songs')->group(function () {
    Route::get('/', [SongController::class, 'index']);
    Route::post('/', [SongController::class, 'store']);
    Route::get('{id}', [SongController::class, 'show']);
});

Route::prefix('playlists')->group(function () {
    Route::get('/', [PlaylistController::class, 'index']);
    Route::post('/', [PlaylistController::class, 'store']);
});

Route::prefix('albums')->group(function () {
    Route::get('/', [AlbumController::class, 'index']);
    Route::post('/', [AlbumController::class, 'store']);
});

Route::get('stats', [StatsController::class, 'index']);
