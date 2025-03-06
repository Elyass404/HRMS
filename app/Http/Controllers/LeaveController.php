<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::all();
        return view('leaves.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leaves.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        


        $validatedData = $request->validate([
        'start_date' => 'required|date|after:required|date|after_or_equal:' . now()->addWeek()->toDateString(),
        'end_date' => 'required|date|after_or_equal:start_date',
        'type' => 'required|string',
    ]);


    Leave::create([
        'employee_id' => auth()->id(),
        'start_date' => $validatedData['start_date'],
        'end_date' => $validatedData['end_date'],
        'type' => $validatedData['type'],
        'status' => 'pending',
    ]);
    
    return redirect()->route('leaves.create')->with('success', 'Leave request submitted successfully!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
