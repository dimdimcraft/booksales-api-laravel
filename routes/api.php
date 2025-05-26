<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
// Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
// Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:api');

// Route::middleware('auth:api')->group(function () {
//    Route::apiResources(['books' => BookController::class,]);
//    Route::apiResources(['genres' => GenreController::class,]);
//    Route::apiResources(['authors' => AuthorController::class,]);
// });

// akses umum
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:api');
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);
Route::apiResource('books', BookController::class)->only(['index', 'show']);

Route::middleware('auth:api')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('genres', GenreController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('authors', AuthorController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('books', BookController::class)->only(['store', 'update', 'destroy']);
    });
});





