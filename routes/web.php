<?php

use App\Http\Controllers\Frontend\ArticleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('dashboard', function () {
    return Inertia::render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [ArticleController::class, 'index'])
    ->name('home');

Route::get('/articles/create', [ArticleController::class, 'create'])
    ->name('articles.create');

Route::get('/articles/{article}', [ArticleController::class, 'show'])
    ->name('articles.show');

require __DIR__.'/settings.php';
