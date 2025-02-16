<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'employees/', 'name' => 'employees.'], function () {
    Route::get('', [EmployeeController::class, 'index'])->name('index');
    Route::post('', [EmployeeController::class, 'store'])->name('store');
    Route::get('{id}', [EmployeeController::class, 'show'])->name('show')->where('id', '[0-9]+');
    Route::patch('{id}', [EmployeeController::class, 'update'])->name('update')->where('id', '[0-9]+');
});
