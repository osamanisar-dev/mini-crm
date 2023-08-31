<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:api')->group(function () {
//    Route::get('/emp_com',[\App\Http\Controllers\EmpComController::class,'getData']);
//});
//Route::get('/emp_com',[\App\Http\Controllers\EmpComController::class,'getData']);


Route::post('/login_api',[\App\Http\Controllers\EmpComController::class,'loginApi']);
Route::middleware('auth:api')->group(function(){
    Route::get('/emp_com',[\App\Http\Controllers\EmpComController::class,'getData']);
});
