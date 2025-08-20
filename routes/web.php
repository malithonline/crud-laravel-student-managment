<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/students');

Route::prefix('students')->name('students.')->group(function () {
    Route::get('/', function () {
        $students = [
            [
                'id' => 1,
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'jane@example.com',
                'contact_number' => '0712345678',
                'date_of_birth' => '2000-01-01',
                'gender' => 'female',
                'type' => 'IT',
                'status' => true,
                'description' => 'sample',
            ],
        ];
        return view('students.index', compact('students'));
    })->name('index');

    Route::get('/create', function () {
        return view('students.create');
    })->name('create');

    Route::post('/', function () {
        return redirect()->route('students.index');
    })->name('store');

    Route::get('{id}/edit', function ($id) {
        $student = [
            'id' => $id,
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'john@example.com',
            'contact_number' => '0711111111',
            'date_of_birth' => '2001-05-10',
            'gender' => 'male',
            'type' => 'Business',
            'status' => false,
            'description' => 'edit sample',
        ];
        return view('students.edit', compact('student'));
    })->name('edit');

    Route::patch('{id}', function ($id) {
        return redirect()->route('students.index');
    })->name('update');

    Route::delete('{id}', function ($id) {
        return back();
    })->name('destroy');
});
