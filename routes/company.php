<?php

use App\Http\Controllers\Company\CompanyController;
use Illuminate\Support\Facades\Route;


Route::middleware('checkLogin')->prefix('/admin/company')->group(function (){
Route::get('/create',[CompanyController::class,'create'])->name('company.create');
Route::post('/store',[CompanyController::class,'store'])->name('company.store');
Route::get('/view',[CompanyController::class,'view'])->name('company.view');
Route::post('/destroy',[CompanyController::class,'destroy'])->name('company.destroy');
Route::get('/edit/{company}',[CompanyController::class,'edit'])->name('company.edit');
Route::post('/update/{company}',[CompanyController::class,'update'])->name('company.update');

});
