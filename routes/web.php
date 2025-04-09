<?php

use App\Http\Controllers\CompaniesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rotas para CompaniesController
Route::resource('companies', CompaniesController::class);