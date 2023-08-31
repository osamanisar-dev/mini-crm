<?php


use App\Http\Controllers\AdminChat\ChatController;
use App\Http\Controllers\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware('checkLogin')->prefix('/admin/employee')->group(function () {
    Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/view', [EmployeeController::class, 'view'])->name('employee.view');
    Route::post('/destroy', [EmployeeController::class, 'destroy'])->name('employee.delete');
    Route::get('/edit/{employee}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/update/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/all/chats', [ChatController::class, 'viewallemp'])->name('admin.allchats');
    Route::post('/chat/{employee}', [ChatController::class, 'employeechat'])->name('selected.admin');
    Route::post('/broadcast', [ChatController::class, 'broadcast']);
    Route::post('/receive', [ChatController::class, 'receive']);
    Route::post('/filter/chat', [ChatController::class, 'filter'])->name('chat.filter');
    Route::post('/notificationTesting', [ChatController::class, 'notificationTesting']);
    Route::get('/mark-as-read', [ChatController::class, 'markAsRead'])->name('mark-as-read');

});


