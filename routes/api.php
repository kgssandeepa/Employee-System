<?php

use App\Models\TaskComment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;



Route::post('/login', [Authcontroller::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('leave-request', [LeaveRequestController::class, 'store']);
    Route::get('leave-request', [LeaveRequestController::class, 'employeeLeaves']);

    //task

    Route::post('tasks', [TaskController::class, 'store']);
    Route::get('tasks', [TaskController::class, 'index']);
    Route::put('tasks/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
    Route::post('task-assign', [TaskController::class, 'assignTask']);

    //comment
    Route::post('task-comment', [TaskController::class, 'TaskComment']);
    Route::get('task-comment', [TaskController::class, 'ViewAllComment']);
    Route::put('task-comment/{id}', [TaskController::class, 'UpdateComment']);
    Route::delete('task-comment/{id}', [TaskController::class, 'DeleteComment']);

    //employye
    Route::post('/employe', [EmployeeController::class, 'store']);
    Route::post('/employe/upload', [EmployeeController::class, 'upload']);


});
