<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// Home page - list students
Route::get('/', [StudentController::class, 'index'])->name('students.index');

// Create student
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

// Edit / Update student
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');

// Delete student (uses DELETE)
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
