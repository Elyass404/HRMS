<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index() {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create() {
        return view('permissions.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $guard_name  = $request->guard_name ?? "web";

        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? "web",
        ]);
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function show(Permission $permission) {
        return view('permissions.show', compact('permission'));
    }

    public function edit(Permission $permission) {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission) {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
