<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('api.employees.index');
    Route::post('/', [EmployeeController::class, 'store'])->name('api.employees.store');
    Route::get('/{id}', [EmployeeController::class, 'show'])->name('api.employees.show');
     Route::get('/{id}', [EmployeeController::class, 'edit'])->name('api.employees.edit');
    Route::put('/{id}', [EmployeeController::class, 'update'])->name('api.employees.update');
    Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('api.employees.destroy');
});
