<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\VisitsController;
use App\Http\Controllers\OcrController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/visits', VisitsController::class);
Route::patch('/visits/{visit}/exit', [VisitsController::class, 'markAsExited'])->name('visits.markAsExited');
Route::get('/visits/{visit}', [VisitsController::class, 'show'])->name('visits.show');
Route::get('/visitas/attendcent', [VisitsController::class, 'attendcent'])->name('visits.attendcent');
Route::get('/visitas/absents', [VisitsController::class, 'absents'])->name('visits.absents');
Route::patch('/visitas/{id}/togglePresence', [VisitsController::class, 'togglePresence']);
Route::resource('/companies', CompaniesController::class);
Route::resource('companies', CompaniesController::class);
Route::resource('/users', UsersController::class);
Route::resource('users', UsersController::class);
<<<<<<<<< Temporary merge branch 1
Route::post('/ocr-matricula', [OcrController::class, 'lerMatricula'])->name('ocr.matricula');
=========
Route::get('/empresas/presentes', [CompaniesController::class, 'presentes']);
Route::get('/empresas/ausentes', [CompaniesController::class, 'ausentes']);
Route::patch('/empresas/{id}/presenca', [CompaniesController::class, 'atualizarPresenca']);



>>>>>>>>> Temporary merge branch 2
