<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerService;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Event;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::all();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        return view('sales.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|integer',
            'user_id' => 'required|integer',
            'malfunction_id' => 'nullable|integer',
            'description' => 'required|string|max:255',
            'priority' => 'required|boolean', // Updated validation for priority
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string',
            'start_appointment' => 'nullable|date_format:H:i',
            'end_appointment' => 'nullable|date_format:H:i',
        ]);

        // Handle 'yes'/'no' if that's how priority is passed
        $validated['priority'] = $request->priority === 'yes' ? 1 : ($request->priority === 'no' ? 0 : $validated['priority']);

        Sales::create($validated);
        return redirect()->route('sales.index')->with('success', 'Afspraak succesvol aangemaakt!');
    }

    public function show(Sales $sale)
    {
        return view('sales.show', compact('sale'));
    }

    public function edit(Sales $sale)
    {
        return view('sales.create', compact('sale'));
    }

    public function update(Request $request, Sales $sale)
    {
        $validated = $request->validate([
            'customer_id' => 'required|integer',
            'user_id' => 'required|integer',
            'malfunction_id' => 'nullable|integer',
            'description' => 'required|string|max:255',
            'priority' => 'required|boolean', // Updated validation for priority
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string',
            'start_appointment' => 'nullable|date_format:H:i',
            'end_appointment' => 'nullable|date_format:H:i',
        ]);

        // Handle 'yes'/'no' if that's how priority is passed
        $validated['priority'] = $request->priority === 'yes' ? 1 : ($request->priority === 'no' ? 0 : $validated['priority']);

        $sale->update($validated);
        return redirect()->route('sales.index')->with('success', 'Afspraak succesvol bijgewerkt!');
    }

    public function destroy(Sales $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Afspraak succesvol verwijderd!');
    }

    public function calendar()
    {
        $customers = Customer::All();

        $events = Event::All();

        return view('calendar', ['events' => $events, 'customers' => $customers]);
    }
}
