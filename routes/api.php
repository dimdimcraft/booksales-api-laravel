<?php

// use App\Http\Controllers\AuthorController;
// use App\Http\Controllers\BookController;
// use App\Http\Controllers\GenreController;
// use App\Http\Controllers\TransactionController;
// use App\Models\Transaction;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// // akses umum
// Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
// Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
// Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:api');

// Route::middleware('auth:api')->group(function () {
//     Route::apiResource('genres', GenreController::class)->only(['store','update', 'show']);
//     Route::apiResource('authors', AuthorController::class)->only(['store','update', 'show']);
//     Route::apiResource('transactions', TransactionController::class)->only(['store','update', 'show']);
//     Route::apiResource('books', BookController::class)->only(['store','update', 'show']);

//     // hanya admin
//     Route::middleware('role:admin')->group(function () {
//         Route::apiResource('genres', GenreController::class);
//         Route::apiResource('authors', AuthorController::class);
//         Route::apiResource('books', BookController::class);
//         Route::apiResource('transactions', TransactionController::class);
//     });
// });

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// akses umum (semua endpoint public)
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

Route::apiResource('genres', GenreController::class);
Route::apiResource('authors', AuthorController::class);
Route::apiResource('transactions', TransactionController::class);
Route::apiResource('books', BookController::class);









