<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerService;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Event;
use App\Models\User;
use App\Models\Malfunction;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::all();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $users = User::all();
        $malfunctions = Malfunction::all();
        return view('sales.create', compact('customers', 'users', 'malfunctions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'user_id' => 'required|integer|exists:users,id',
            'malfunction_id' => 'nullable|integer|exists:malfunctions,id',
            'description' => 'required|string|max:255',
            'priority' => 'required|boolean',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string',
            'start_appointment' => 'nullable|date_format:H:i',
            'end_appointment' => 'nullable|date_format:H:i',
        ]);

        if ($request->start_appointment) {
            $validated['start_appointment'] = $request->date . ' ' . $request->start_appointment . ':00';
        }
        if ($request->end_appointment) {
            $validated['end_appointment'] = $request->date . ' ' . $request->end_appointment . ':00';
        }

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
        $customers = Customer::all();
        $users = User::all();
        $malfunctions = Malfunction::all();
        return view('sales.create', compact('sale', 'customers', 'users', 'malfunctions'));
    }

    public function update(Request $request, Sales $sale)
    {
        $validated = $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'user_id' => 'required|integer|exists:users,id',
            'malfunction_id' => 'nullable|integer|exists:malfunctions,id',
            'description' => 'required|string|max:255',
            'priority' => 'required|boolean',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string',
            'start_appointment' => 'nullable|date_format:H:i',
            'end_appointment' => 'nullable|date_format:H:i',
        ]);

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
        $customers = Customer::all();
        $events = Event::all();

        return view('calendar', ['events' => $events, 'customers' => $customers]);
    }
}
