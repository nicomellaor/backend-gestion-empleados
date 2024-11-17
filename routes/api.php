<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/employees', [EmployeeController::class, 'getEmployees']);
Route::post('/employees', [EmployeeController::class, 'createEmployee']);
Route::put('/employees', [EmployeeController::class, 'modifyEmployee']);
Route::delete('/employees', [EmployeeController::class, 'deleteEmployee']);