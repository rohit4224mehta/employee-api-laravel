<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

Route::post('/sanctum/token', [AuthController::class, 'generateApiToken']);

Route::middleware('auth:sanctum')->prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('api.employees.index');
    Route::post('/', [EmployeeController::class, 'store'])->name('api.employees.store');
    Route::get('/{id}', [EmployeeController::class, 'show'])->name('api.employees.show');
    Route::put('/{id}', [EmployeeController::class, 'update'])->name('api.employees.update');
    Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('api.employees.destroy');
});
