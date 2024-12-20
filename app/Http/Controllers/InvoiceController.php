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
        $request->validate([
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $invoice = new Invoice();
        $invoice->customer_id = $customer->id;
        $invoice->description = $request->description;
        $invoice->price = $request->price;
        $invoice->quantity = $request->quantity;
        $invoice->total = $request->price * $request->quantity;
        $invoice->save();

        session(['new_invoice' => $invoice]);

        return redirect()->route('customers.show', $customer->id)->with('success', 'Invoice created successfully.');
    }

}
