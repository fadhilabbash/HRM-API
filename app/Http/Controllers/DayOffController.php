<?php

namespace App\Http\Controllers;

use App\Models\DayOff;
use App\Models\Employee;
use Illuminate\Http\Request;

class DayOffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DayOff $dayOff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DayOff $dayOff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DayOff $dayOff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DayOff $dayOff)
    {
        //
    }

    public function getEmployeeDaysOff($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $daysOff = $employee->daysOff;  // Retrieve all days off for the employee

        return response()->json($daysOff);
    }

    // Create a new day off for an employee
    public function createDayOff(Request $request, $employeeId)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|string',
            'paid' => 'boolean',
        ]);

        $employee = Employee::findOrFail($employeeId);

        $dayOff = $employee->daysOff()->create([
            'date' => $request->date,
            'type' => $request->type,
            'paid' => $request->paid,
        ]);

        return response()->json($dayOff, 201);
    }
}
