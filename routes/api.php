<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DayOffController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDayOffController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\TimeOffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//Employee
Route::apiResource('employees', EmployeeController::class);

//Positions
Route::apiResource('positions', PositionController::class);

Route::prefix('employees/{employeeId}')->group(function () {
    // Time Off Routes
    Route::post('time-offs', [TimeOffController::class, 'store']);  // Store time off request
    Route::get('time-offs/{date}', [TimeOffController::class, 'getTotalTimeOff']);  // Get total time off for a specific date
    Route::get('total-time-off', [TimeOffController::class, 'getTotalTimeOffForEmployee']);  // Get total time off for an employee

    // Days Off Routes
    Route::post('days-off', [DayOffController::class, 'createDayOff']);  // Create a new day off for an employee
    Route::get('days-off', [DayOffController::class, 'getEmployeeDaysOff']);  // Get all days off for an employee
});
