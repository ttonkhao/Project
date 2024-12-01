<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeExpenseController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/save', [IncomeExpenseController::class, 'save']);

