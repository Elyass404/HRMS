<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Position;


class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create(){
        $roles = Role::all();
        $positions = Position::all();
        $departments = Department::all();
        return view('users.create', compact("roles","positions","departments"));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'status' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:255',
            'contract_type' => 'nullable|string|max:255',
            'role' => 'required|string',
        ]);

        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'position' => $request->position,
            'department' => $request->department,
            'hire_date' => $request->hire_date,
            'status' => $request->status,
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'contract_type' => $request->contract_type,
            'profile_picture' => $request->profile_picture,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    
    public function show(User $user){
        return view('user.show', compact('user'));
    }

    public function edit(User $user){
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'status' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:255',
            'contract_type' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'position' => $request->position,
            'department' => $request->department,
            'hire_date' => $request->hire_date,
            'status' => $request->status,
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'contract_type' => $request->contract_type,
            'profile_picture' => $request->profile_picture,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('users.index')->with('success','The employee has been deleted with success');
    }
}
