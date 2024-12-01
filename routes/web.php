<?php

declare(strict_types=1);

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/todos', [TodoController::class, 'index'])
    ->name('todos.index');

Route::post('/todos', [TodoController::class, 'store'])
    ->name('todos.store');
