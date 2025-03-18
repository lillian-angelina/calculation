<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;

Route::get('/expenses/monthly', [ExpenseController::class, 'monthly'])->name('expenses.monthly');
Route::get('/expenses/weekly', [ExpenseController::class, 'weekly'])->name('expenses.weekly');

Route::resource('expenses', ExpenseController::class);