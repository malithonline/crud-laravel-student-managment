<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::redirect('/', '/students');

Route::resource('students', StudentController::class);
Route::patch('students/{student}/toggle', [StudentController::class, 'toggle'])->name('students.toggle');
