<?php


use App\Http\Controllers\VisitsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/visits', VisitsController::class);

