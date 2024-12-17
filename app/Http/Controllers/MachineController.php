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
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);

        try {
            $machine = Machine::create([
                'name' => $request->name,
                'price' => $request->price,
                'status' => $request->status,
            ]);

            return redirect()->route('machines.index', ['id' => $machine->id])
                ->with('success', 'Machine succesvol toegevoegd!');
        } catch (\Exception $e) {
            Log::error('Machine opslaan mislukt: ' . $e->getMessage());
            return back()->withErrors('Er is een fout opgetreden tijdens het opslaan. Probeer opnieuw.')
                ->withInput();
        }
    }


    public function edit($id)
    {
        $machine = Machine::findOrFail($id);
        return view('machines.machines-edit', compact('machine'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);
    
        $machine = Machine::findOrFail($id);
        $machine->update([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
        ]);
    
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
