<?php
namespace App\Http\Controllers;

use App\Models\LeaseContract;
use App\Models\Customer;
use App\Models\User;
use App\Models\Machine;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function index()
    {
        $leaseContracts = LeaseContract::with('customer', 'user', 'machines')->get();
        return view('leasecontracts.index', compact('leaseContracts'));
    }

    public function show($id)
    {
        $leaseContract = LeaseContract::with('customer', 'user', 'machines')->findOrFail($id);
        return view('leasecontracts.show', compact('leaseContract'));
    }

    public function create()
    {
        $customers = Customer::all();
        $users = User::all();
        $machines = Machine::all();
        return view('leasecontracts.create', compact('customers', 'users', 'machines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'payment_method' => 'required|string',
            'machine_amount' => 'required|integer|min:1',
            'notice_period' => 'required|string',
            'status' => 'required|string|in:pending,active,terminated,completed',
        ]);

        LeaseContract::create($validated);

        return redirect()->route('leasecontracts.index')->with('success', 'Leasecontract aangemaakt!');
    }

    public function edit($id)
    {
        $leaseContract = LeaseContract::findOrFail($id);
        $customers = Customer::all();
        $users = User::all();
        $machines = Machine::all();
        return view('leasecontracts.edit', compact('leaseContract', 'customers', 'users', 'machines'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'payment_method' => 'required|string',
            'machine_amount' => 'required|integer|min:1',
            'notice_period' => 'required|string',
            'status' => 'required|string|in:pending,active,terminated,completed',
        ]);

        $leaseContract = LeaseContract::findOrFail($id);
        $leaseContract->update($validated);

        return redirect()->route('leasecontracts.index')->with('success', 'Leasecontract bijgewerkt!');
    }

    public function destroy($id)
    {
        $leaseContract = LeaseContract::findOrFail($id);
        $leaseContract->delete();

        return redirect()->route('leasecontracts.index')->with('success', 'Leasecontract verwijderd!');
    }
}
