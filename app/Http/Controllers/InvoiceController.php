<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function create(Customer $customer)
    {
        return view('invoices.create', compact('customer'));
    }

    public function store(Request $request, Customer $customer)
    {
        // Validate arrays of invoice items
        $request->validate([
            'description.*' => 'required|string|max:255',
            'price.*' => 'required|numeric|min:0',
            'quantity.*' => 'required|integer|min:1',
        ]);

        $invoices = []; // To store newly created invoices for session or further use

        // Loop through each item and create an invoice entry
        foreach ($request->description as $index => $description) {
            $invoice = new Invoice();
            $invoice->customer_id = $customer->id;
            $invoice->description = $description;
            $invoice->price = $request->price[$index];
            $invoice->quantity = $request->quantity[$index];
            $invoice->total = $request->price[$index] * $request->quantity[$index];
            $invoice->save();

            $invoices[] = $invoice;
        }

        // Store the newly created invoices in the session (optional)
        session(['new_invoices' => $invoices]);

        return redirect()
        ->route('customers')
        ->with('success', 'Facturen succesvol opgeslagen!');
    }
}
