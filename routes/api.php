<?php

use App\Http\Controllers\EmpComController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login_api', [EmpComController::class, 'loginApi']);
Route::middleware('auth:api')->group(function () {
    Route::get('/emp_com', [EmpComController::class, 'getData']);
});
