<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'index']);

Route::get('/add', [StudentController::class, 'create']);
Route::post('/store', [StudentController::class, 'store']);

Route::get('/delete/{id}', [StudentController::class, 'delete']);

Route::get('/edit/{id}', [StudentController::class, 'edit']);
Route::post('/update/{id}', [StudentController::class, 'update']);
