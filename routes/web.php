<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\VisitsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/visits', VisitsController::class);
Route::patch('/visits/{visit}/exit', [VisitsController::class, 'markAsExited'])->name('visits.markAsExited');
Route::resource('/companies', CompaniesController::class);
Route::resource('/users', UsersController::class);
