<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MachineController extends Controller
{
    public function index()
    {
        // Haal alle machines op en stuur ze naar de view
        $machines = Machine::all();
        return view('machines.machines-show', compact('machines'));
    }

    public function create()
    {
        return view('machines.machines-create');
    }


    public function store(Request $request)
    {
        // Valideer de gegevens
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string|max:255',
            'storage_id' => 'required|exists:storages,id', // Controleer of het opslag-ID bestaat
        ]);

        try {
            // Maak een nieuwe machine aan en bewaar deze in een variabele
            $machine = Machine::create([
                'name' => $request->name,
                'price' => $request->price,
                'status' => $request->status,
                'storage_id' => $request->storage_id,
            ]);

            // Gebruik de ID van de nieuwe machine voor de redirect
            return redirect()->route('machines.index', ['id' => $machine->id])
                ->with('success', 'Machine succesvol toegevoegd!');
        } catch (\Exception $e) {
            // Log de fout en stuur de gebruiker terug met een foutmelding
            Log::error('Machine opslaan mislukt: ' . $e->getMessage());
            return back()->withErrors('Er is een fout opgetreden tijdens het opslaan. Probeer opnieuw.')
                ->withInput();
        }
    }


    public function edit($id)
    {
        // Haal de machine op om te bewerken
        $machine = Machine::findOrFail($id);
        return view('machines.machines-edit', compact('machine'));
    }

    public function update(Request $request, $id)
    {
        // Valideer de aanvraag
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);
    
        // Zoek de machine op en werk deze bij
        $machine = Machine::findOrFail($id);
        $machine->update([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
        ]);
    
        // Redirect naar de overzichtspagina (index) van de machines
        return redirect()->route('machines.index')->with('success', 'Machine succesvol bijgewerkt!');
    }

    public function destroy($id)
    {
        // Verwijder de machine
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
