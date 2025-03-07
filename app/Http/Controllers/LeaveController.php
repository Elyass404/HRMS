<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;


class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Check the user's role
        if ($user->hasRole('Employee')) {
            // Show leave requests for the logged-in employee only
            $leaves = Leave::where('employee_id', $user->id)->get();
        } elseif ($user->hasRole('Manager')) {
            // Show leave requests for employees in the same department as the manager
            $leaves = Leave::whereHas('employee', function ($query) use ($user) {
                $query->where('department', $user->department);
            })->get();
        } else {
            // Show all leave requests for HR
            $leaves = Leave::all();
        }
    
        

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
        'start_date' => 'required|date|after_or_equal:' . now()->addWeek()->toDateString(),
        'end_date' => 'required|date|after:start_date',
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
    public function edit($id)
{
    // to brind the information of the leave demand you clicked on 
    $leave = Leave::findOrFail($id); // i found this new findOrFail and it helps to handle the error if the wanted element doesnt exist

    return view('leaves.edit', compact('leave'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'manager_approval' => 'nullable|string|in:pending,approved,rejected',
            'hr_approval' => 'nullable|string|in:pending,approved,rejected',
        ]);
    
        // bring the leave request
        $leave = Leave::findOrFail($id);

        if (auth()->user()->hasRole('Admin')) {
            $leave->update([
                'manager_approval' => $validatedData['manager_approval'],
                'hr_approval' => $validatedData['hr_approval'],
            ]);
        }
    
        // update manager or HR approval fields
        if (auth()->user()->hasRole('Manager')) {
            $leave->update([
                'manager_approval' => $validatedData['manager_approval'],
            ]);
        }
    
        if (auth()->user()->hasRole('HR')) {
            $leave->update([
                'hr_approval' => $validatedData['hr_approval'],
            ]);
        }
    
        // make the generl status
        if ($leave->manager_approval === 'rejected' || $leave->hr_approval === 'rejected') {
            $leave->update(['status' => 'rejected']);
        } elseif ($leave->manager_approval === 'approved' && $leave->hr_approval === 'approved') {
            $leave->update(['status' => 'approved']);
        } else {
            $leave->update(['status' => 'pending']);
        }
        

        return redirect()->route('leaves.index')->with('success', 'Leave request updated successfully!');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
