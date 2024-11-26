<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;

class SalesController extends Controller
{
    // Toon alle afspraken
    public function index()
    {
        $sales = Sales::all();
        return view('sales.index', compact('sales'));
    }

    // Toon het formulier voor het aanmaken van een nieuwe afspraak
    public function create()
    {
        return view('sales.create');
    }

    // Sla een nieuwe afspraak op in de database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|integer',
            'user_id' => 'required|integer',
            'malfunction_id' => 'nullable|integer',
            'description' => 'required|string|max:255',
            'priority' => 'required|integer',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string',
            'start_appointment' => 'nullable|date_format:H:i',
            'end_appointment' => 'nullable|date_format:H:i',
        ]);

        Sales::create($validated);
        return redirect()->route('sales.index')->with('success', 'Afspraak succesvol aangemaakt!');
    }

    // Toon een specifieke afspraak
    public function show(Sales $sale)
    {
        return view('sales.show', compact('sale'));
    }

    // Toon het formulier voor het bewerken van een afspraak
    public function edit(Sales $sale)
    {
        return view('sales.create', compact('sale'));
    }

    // Werk een afspraak bij
    public function update(Request $request, Sales $sale)
    {
        $validated = $request->validate([
            'customer_id' => 'required|integer',
            'user_id' => 'required|integer',
            'malfunction_id' => 'nullable|integer',
            'description' => 'required|string|max:255',
            'priority' => 'required|integer',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string',
            'start_appointment' => 'nullable|date_format:H:i',
            'end_appointment' => 'nullable|date_format:H:i',
        ]);

        $sale->update($validated);
        return redirect()->route('sales.index')->with('success', 'Afspraak succesvol bijgewerkt!');
    }

    // Verwijder een afspraak
    public function destroy(Sales $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Afspraak succesvol verwijderd!');
    }
}
