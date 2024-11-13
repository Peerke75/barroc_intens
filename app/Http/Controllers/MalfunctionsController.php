<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Malfunction;
use App\Models\Customer;

class MalfunctionsController extends Controller
{
    /**
     * Toon een lijst van alle storingen.
     */
    public function index()
    {
        $malfunctions = Malfunction::with('customer')->get();
        return view('malfunctions.malfunction-index', compact('malfunctions'));
    }

    /**
     * Toon het formulier om een nieuwe storing aan te maken.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('malfunctions.malfunction-create', compact('customers'));
    }

    /**
     * Sla een nieuwe storing op in de database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Malfunction::create($request->all());

        return redirect()->route('storingen.index')->with('success', 'Storing succesvol aangemaakt.');
    }

    /**
     * Toon een specifieke storing.
     */
    public function show(Malfunction $malfunction)
    {
        $malfunction = Malfunction::with('customer')->findOrFail($malfunction->id);
        return view('malfunctions.malfunction-show', compact('malfunction'));
    }

    /**
     * Toon het formulier om een bestaande storing te bewerken.
     */
    public function edit(Malfunction $malfunction)
    {
        $customers = Customer::all();
        return view('malfunctions.malfunction-edit', compact('malfunction', 'customers'));
    }

    /**
     * Werk een bestaande storing bij in de database.
     */
    public function update(Request $request, Malfunction $malfunction)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $malfunction->update($request->all());

        return redirect()->route('storingen.index')->with('success', 'Storing succesvol bijgewerkt.');
    }

    /**
     * Verwijder een bestaande storing uit de database.
     */
    public function destroy(Malfunction $malfunction)
    {
        $malfunction->delete();

        return redirect()->route('storingen.index')->with('success', 'Storing succesvol verwijderd.');
    }
}
