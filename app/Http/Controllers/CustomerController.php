<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Invoice;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('invoices')->get();
        return view('customers.klanten-show', compact('customers',));
    }

    public function create()
    {
        return view('customers.create'); // Laad de create-view
    }

    public function store(Request $request)
    {
        // Validatie van het formulier
        $validatedData = $request->validate([
            'contract_id' => 'required|integer',
            'contact_persons_id' => 'required|integer',
            'company_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'mail' => 'required|email|unique:customers',
            'BKR_check' => 'required|boolean',
            'order_status' => 'nullable|string',
        ]);

        // Nieuwe klant maken en opslaan
        Customer::create($validatedData);

        // Redirect naar de klantenlijst met een succesbericht
        return redirect()->route('customers')->with('success', 'Klant succesvol toegevoegd!');
    }

    public function edit(Customer $customer)
    {
        $customer = Customer::findOrFail($customer->id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        // Validatie van het formulier
        $validatedData = $request->validate([
            'contract_id' => 'required|integer',
            'contact_persons_id' => 'required|integer',
            'company_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'mail' => 'required|email|unique:customers',
            'BKR_check' => 'required|boolean',
            'order_status' => 'nullable|string',
        ]);

        // Klant updaten
        $customer->update($validatedData);

        // Redirect naar de klantenlijst met een succesbericht
        return redirect()->route('customers')->with('success', 'Klant succesvol geüpdatet!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Klant succesvol verwijderd!');
    }

    private function generateConnectionFeeInvoice($customerId)
    {
        return [
            'number' => "CF-" . rand(10000, 99999),
            'description' => "Connection Fee",
            'price' => 100.00,
            'quantity' => 1,
            'total' => 100.00,
        ];
    }
}
