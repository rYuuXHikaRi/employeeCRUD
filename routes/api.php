<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EmployeesController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/employees', [EmployeesController::class, 'index']);
Route::get('/employees/{id}', [EmployeesController::class, 'show']);