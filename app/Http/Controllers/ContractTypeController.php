<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContractType;

class ContractTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contractTypes = ContractType::all();
        return view('contract-types.index', compact('contractTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contract-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ContractType::create($request->all());

        return redirect()->route('contract-types.index')->with('success', 'Contract Type created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContractType $contractType)
    {
        return view('contract-types.edit', compact('contractType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContractType $contractType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $contractType->update($request->all());

        return redirect()->route('contract-types.index')->with('success', 'Contract Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContractType $contractType)
    {
        $contractType->delete();
        return redirect()->route('contract-types.index')->with('success', 'Contract Type deleted successfully.');
    }
}
