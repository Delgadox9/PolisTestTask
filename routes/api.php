<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('articles', [ArticleController::class, 'index'])->name('api.articles.index');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('api.articles.show');
Route::post('articles', [ArticleController::class, 'store'])->name('api.articles.store');

Route::post('login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::ApiResource('comments', CommentsController::class);
});
