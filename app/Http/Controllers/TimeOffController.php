<?php

// app/Http/Controllers/TimeOffController.php

namespace App\Http\Controllers;

use App\Models\TimeOff;
use App\Models\Employee;
use Illuminate\Http\Request;

class TimeOffController extends Controller
{
    // Store a new time off request for an employee
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'start_hour' => 'required|integer|min:0|max:23',  // Start hour (0-23)
            'end_hour' => 'required|integer|min:0|max:23',  // End hour (0-23)
            'type' => 'required|string',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        // Calculate the total hours taken off for this request
        $totalHours = $request->end_hour - $request->start_hour;

        // Create the time off record
        $timeOff = TimeOff::create([
            'employee_id' => $request->employee_id,
            'start_date' => $request->start_date,
            'start_hour' => $request->start_hour,
            'end_hour' => $request->end_hour,
            'total_hours' => $totalHours,
            'type' => $request->type,
            'status' => $request->status
        ]);

        return response()->json($timeOff, 201);
    }

    // Get total time off taken by an employee for a specific date
    public function getTotalTimeOff($employeeId, $date)
    {
        // Calculate the total hours taken off by the employee for the specific date
        $totalHours = TimeOff::where('employee_id', $employeeId)
            ->where('start_date', $date)
            ->where('status', 'approved')  // Only approved time off records
            ->sum('total_hours');  // Aggregate the total hours for the date

        return response()->json(['total_hours' => $totalHours]);
    }

    // Get total time off for an employee across multiple days
    public function getTotalTimeOffForEmployee($employeeId)
    {
        // Aggregate all hours taken off by the employee
        $totalHours = TimeOff::where('employee_id', $employeeId)
            ->where('status', 'approved')  // Only approved time off records
            ->sum('total_hours');  // Sum the total hours taken off

        return response()->json(['total_hours' => $totalHours]);
    }
}
