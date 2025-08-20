<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::redirect('/', '/students');

Route::middleware('auth')->group(function () {
    Route::resource('students', StudentController::class);
    Route::patch('students/{student}/toggle', [StudentController::class, 'toggle'])->name('students.toggle');
    Route::get('export/excel', [ExportController::class, 'excel'])->name('export.excel');
    Route::get('export/xlsx', [ExportController::class, 'xlsx'])->name('export.xlsx');
    Route::get('export/pdf', [ExportController::class, 'pdf'])->name('export.pdf');
});
