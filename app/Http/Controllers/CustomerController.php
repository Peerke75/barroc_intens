<?php

namespace App\Http\Controllers;

use App\Models\Customer;  // Import the Customer model
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Fetch all customers from the database
        $customers = Customer::all();

        // Pass customers to the view
        return view('customers.klanten-show', compact('customers'));
    }
}
