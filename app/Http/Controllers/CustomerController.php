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

        // CustomerController.php
    public function show($customerId)
    {
        $customer = Customer::find($customerId);

        // Generate connection fee invoice
        $invoice = $this->generateConnectionFeeInvoice($customerId);

        return view('customers.show', compact('customer', 'invoice'));
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
