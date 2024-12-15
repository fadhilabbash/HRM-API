<?php
// app/Http/Controllers/PositionController.php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    // Get all positions
    public function index()
    {
        $positions = Position::all();
        return response()->json($positions);
    }

    // Store a new position
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $position = Position::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($position, 201);
    }


    // Get a specific position
    public function show($id)
    {
        $position = Position::findOrFail($id);
        return response()->json($position);
    }

    // Update a position
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $position = Position::findOrFail($id);
        $position->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($position);
    }

    // Delete a position
    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return response()->json(['message' => 'Position deleted successfully']);
    }
}
