<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebEmployeeController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/employees', [WebEmployeeController::class, 'index'])->name('employees.index');
    Route::post('/employees', [WebEmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [WebEmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}', [WebEmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [WebEmployeeController::class, 'destroy'])->name('employees.destroy');
});
