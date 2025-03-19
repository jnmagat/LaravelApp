<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DashboardController;

Route::get('/login',[AuthController::class, 'showLoginForm'])->name('login.form');  
Route::post('/login',[AuthController::class, 'login'])->name('login');  

Route::get('/register',[AuthController::class, 'showRegisterForm'])->name('register.form');  
Route::post('/register',[AuthController::class, 'register'])->name('register');  

Route::middleware(AuthMiddleware::class)->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/employee',[EmployeeController::class, 'index'])->name('employee');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
    Route::put('/employees/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/delete/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    

    Route::get('/department',[DepartmentController::class, 'index'])->name('department');  
    Route::post('/departments/store', [DepartmentController::class, 'store']);
    Route::put('/departments/update/{id}', [DepartmentController::class, 'update']);
    Route::delete('/departments/delete/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/{any}', function () {
        return redirect()->route('dashboard'); // Redirect to dashboard
    })->where('any', '.*'); 
});