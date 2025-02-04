<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::all();
        return view('machines.machines-show', compact('machines'));
    }

    public function create()
    {
        return view('machines.machines-create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive,maintenance',
            'description' => 'required|string',
        ]);

        Machine::create($validatedData);

        return redirect()->route('machines.index')->with('success', 'Machine succesvol toegevoegd!');
    }




    public function edit($id)
    {
        $machine = Machine::findOrFail($id);
        return view('machines.machines-edit', compact('machine'));
    }

    public function update(Request $request, Machine $machine)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive,maintenance',
            'description' => 'required|string',
        ]);

        $machine->update($validatedData);

        return redirect()->route('machines.index')->with('success', 'Machine succesvol bijgewerkt!');
    }

    public function destroy($id)
    {
        $machine = Machine::findOrFail($id);
        $machine->delete();

        return redirect()->route('machines.index')->with('success', 'Machine succesvol verwijderd!');
    }

    public function show($id)
    {
        $machine = Machine::findOrFail($id);
        return view('machines.machines-info', compact('machine'));
    }
}
