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
        return view('customers.klanten-show', compact('customers'));
    }

}
